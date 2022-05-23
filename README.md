# Laravel Session dengan Login

## Anggota Kelompok
Kelompok 13 <br />
1. Erki Kadhafi Rosyid 05111940000050
2. Elshe Erviana Angely 5025201050

## Daftar Isi
- [Migration pada Database]()
- [Controller]()
- [View]()
- [Route]()

## Studi Kasus
Dalam project session ini, kelompok kami mengambil studi kasus berupa login dan register yang sessionnya akan disimpan dalam database.
### Migration pada Database
1. Langkah pertama dalam pembuatan project ini adalah mengatur file `.env`. dengan mengganti nama database sesuai yang sudah dibuat dalam phpmyadmin.
    ```txt
    DB_DATABASE=[nama-database]
    ```
2. Langkah kedua adalah membuat model dan migration dengan perintah berikut pada terminal:
    ```
    php artisan make:model User
    ```
3. Langkah ketiga adalah mengisi `\app\Models\User.php` sebagai berikut
    ```php
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    ```
4. Langkah ketiga adalah mengisi `\database\migrations\` pada file `create_users_table`
    ```php
    public function up()
    {
        // Isian dimulai pada bagian ini:
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    ```
5. Langkah keempat adalah melakukan migrasi tabel ke database dengan perintah
    ```
    php artisan migrate:fresh
    ```

### Controller 
Selanjutnya adalah membuat controller. <br />
1. Langkah pertama adalah membuat controller yaitu `UserController` dengan perintah
    ```
    php artisan make:controller UserController
    ```

2. Pada `\app\Http\Controllers\UserController` ditambahkan controller
    ```php
    public function index()
    {
        return view('registration'); // user melakukan registrasi
    }

    public function userPostRegistration(Request $request)
    {
        // validasi input pada field
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $input = $request->all();

        // membuat inputArray untuk menyimpan password dalam bentuk Hash
        $inputArray = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        );

        // register user
        $user = User::create($inputArray);
        $email = User::where('email', $request['email'])->first();

        // menggunakan flash message sukses ketika user berhasil dibuat
        if (!is_null($user)) {
            return back()->with('success', 'You have registered successfully.');
        }

        // jika tidak akan mereturn error
        else {
            return back()->with('error', 'Whoops! some error encountered. Please try again.');
        }
    }

    public function userLoginIndex()
    {
        return view('login'); // user login view
    }

    public function userPostLogin(Request $request)
    {

        $request->validate([
            "email"           =>    "required|email",
            "password"        =>    "required|min:6"
        ]);

        $userCredentials = $request->only('email', 'password');
        // menyimpan request dalam kredensial, hanya email dan passsword

        // melakukan pengecekan user dengan Auth, mulai membuat session setelah redirect->intended
        if (Auth::attempt($userCredentials)) {
            return redirect()->intended('dashboard');
        } else {
            return back()->with('error', 'Whoops! invalid username or password.');
        }
    }

    public function dashboard()
    {

        // cmengecek apabila user login maka akan mereturn view dashboard dengan auth
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect::to("user-login")->withSuccess('Oopps! You do not have access');
    }

    // user melakukan logout dan mendestroy session
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('user-login');
    }
    ```


### View
Setelah membuat controller akan dibuat view. View secara lengkap dapat diakses pada: [\resources\views](https://github.com/UrSourceCode/laravel-session/tree/main/resources/views)

### Route
Langkah selanjutnya adalah membuat route yaitu sebagai berikut:
```php
Route::get('/user-registration', [UserController::class, 'index'])->name('user.registration');

Route::post('/user-store', [UserController::class, 'userPostRegistration']);

Route::get('/user-login', [UserController::class, 'userLoginIndex']);

Route::post('/login', [UserController::class, 'userPostLogin']);

Route::get('/dashboard', [UserController::class, 'dashboard']);

Route::get('/logout', [UserController::class, 'logout']);
```