Using PHP, develop a CRUD application for storing contacts.
With the application, a user must be able to bulk import contacts using XML
There is an example XML attached.
Deploy your code on github and share the link to the project.

Requirements
You may use any DB you want
Use Laravel framework.


Assignment:

KöktenAdal+90 333 8859342
HammaAbdurrezak+90 333 1563682
GüleycanŞensal+90 333 2557114
SuadiyeRatip+90 333 9163726
BarikNurşide+90 333 3323749
HanifiEmineeylem+90 333 2763531
NakiyeOğulkan+90 333 6168924
HamsiyeCerit+90 333 3544579
MahfiHülâgü+90 333 8937773
EsmerayNurihayat+90 333 1688759
ŞennurNazifer+90 333 5326326
ÇetinokSeden+90 333 1614182



According to above assignment
I've created CRUD with complete validation

For import XML file

I've developed the code according to your example data [Because User can create XML file according their own choice]
I've also added code for CSV file data import

Due to limited description and simple requirement i've created this site in my own simple way


All about Laravel

1) Install PHP:
	Windows - https://www.php.net/downloads.php
	Ubuntu - 
		-  update the package manager cache by running: sudo apt update
		-  install the required packages: sudo apt install php-cli unzip

==============================================================================================

2) Install Composer:
	- https://getcomposer.org/download/

==============================================================================================

3) Create Laravel project:
	- composer create-project laravel/laravel example-app
	- FOr specific version - composer create-project laravel/laravel:10 event-ticketing
	- Make changes in your .env file 

Cache clear command:
php artisan config:clear
php artisan cache:clear
php artisan optimize

==============================================================================================

4) make service provider : php artisan make:provider provider_name
	- We need to define service provider in config/app.php file

==============================================================================================

5) For database:
	- create migration : php artisan make:migration create_student_table
	- run migration : php artisan migrate
	- On production, sometimes migrate command can not run because of security, so we can use this command: php artisan migrate -- force
	- Rollback migration : php artisan migrate:rollback
	- Rollback reset (remove all tables except migration table) : php artisan migrate:reset
	- Update migration (Add new column) : php artisan make:migration update_students_table --table=users
		- Rename column: $table->renameColumn('from', 'to')
		- Drop column: $table->dropColumn('name') , $table->dropColumn(['name', 'avatar']) 
		- Change column size : $table->string('name', 50)->change()
		- Change column order : $table->after('password', function () {
			$table->string('address')
			.........................
		})
	- Add foreign key: 
		- $table->foreign('current_table_field')->references('reference_table_field')->on('main_table_name')->onUpdate('cascade')->onDelete('cascade') [onDelete('set null')]
		- This is for create the field and make foreign key without showing master table id : $table->foreignId('current_table_field')->constrained('main_table_name')
$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
$table->foreignId('user_id')->constrained('users')
==============================================================================================

6) define routes:
	- Route::get('user', [UserController::class, 'index']);
	- Route::get('login', 'LoginController@login')->name('login');

==============================================================================================

7) For optinal parameter in route:  Route::get('user/{name?}', [UserController::class, 'index']);

==============================================================================================

8) regular expression route:
	- Contain alpha ::  Route::get('/user/{name}', [UserController::class, 'index'])->where('name', '[A-Za-z]+');
	- Function for where : whereNumber, whereAlphaNumeric, whereIn

==============================================================================================

9) Create model with migration 
	- Command : php artisan make:model Admin -m 

==============================================================================================

10) Seeder and Factory:
	- Seeder will use for add real data
	- Factory will use for add fake data
	- Seeder Command: 	
		- php artisan make:seeder seeder_name
		- function :
			public function run() {
				MODEL:create([
					'field_name' => value,
					...............
				])
			}
	- define that which seeder file need to run: 
		- Seeders/DatabaseSeeder.php 
			- $this->call([
				seeder_name::class
			])
	- Run seeder Command
		- php artisan db:seed
		- Run single seeder file: php artisan db:seed --class=seeder_file_name

==============================================================================================

11) For Query Builder:
	- Add facads for DB
	- DB::table('table_name')->where(...)->orWhere(...)->get();
		- whereIn()
		- whereBetween()
		- whereNull()
		- whereMonth()
		- whereDay()
		- whereYear()
		- whereTime()

==============================================================================================

12) Create middleware : php artisan make:middleware RoleMiddleware
	- In Middleware file check that your role is correct or not
		- Example: 
		funtion handle(Request $request, Closure $next, $role) {
			if(auth()->user() && auth()->user()->role == $role) {
				return $next($request);
			}
		}
	- Define middleware in Kernel.php : in routeMiddleware array define your middleware name and it's path
		- the middlware name will use in our route files
			- Example : 'role' => App\Http\Middleware\RoleMiddleware::class



==============================================================================================
13) Login With Gaurd:

1) Make view Login page and pass @csrf token
2) Make Gaurd:
    - Register Provider in Auth.php file
        - guards-> 'Admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        - 'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class
        ]
    - Add these code in Authenticate middleware
        if($request->routeIs('admin.*')) {
            return route('admin.login');
        }
    - Add these code in RedirectIfAuthenticated middleware
        public function handle(Request $request, Closure $next, $guard = null)
        {
            if($guard == 'Admin' && Auth::guard($guard)->check()) {
                redirect(RouteServiceProvider::ADMINHOME);
            }
            return $next($request);
        }
    - Add this code in RouteServiceProvider service provider
        public const ADMINHOME = '/admin/dashboard';

3) check credentials:
   	$request->validate([
	    'email' => 'required|email',
	    'password' => "required|min:6"
	]);
	if (Auth::guard('Admin')->attempt($request->only('email', 'password'), $request->filled('remember_me'))) {
	    return redirect('admin/dashboard');
	} else {
	    return redirect()->back()->withInput()->with('invalid_login', 'Invalid email or password.');
	}
4) Make migration and seeder
6) change in login page method
    public function login_form()
    {
        if(Auth::guard('Admin')->check()) {
            redirect('admin/dashboard');
        } else {
            return view('admin.auth.login');
        }
    }
7) Make dashboard and display error/
8) View:
    @if(session('invalid_login'))
    <div class="alert alert-danger" role="alert">
        {{ session('invalid_login') }}
    </div>
    @endif
    <form class="needs-validation" action="{{ url('admin/check_credentials') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group floating-label col-md-12">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group floating-label col-md-12">
                <label>Password</label>
                <input type="password" name="password" class="form-control ">
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>
    </form>
9) change on Modal:
    <?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    class Admin extends Authenticatable
    {
        use HasFactory;
        protected $guard = 'Admin';
        protected $fillable = ['name', 'email', 'password'];
    }
10) Logout
    public function admin_logout() {
        Auth::guard('Admin')->logout();
        return redirect('admin/login');
    }


==============================================================================================
Easy Toastr

https://github.com/yoeunes/toastr
super@123

==============================================================================================
flasher-toastr
php-flasher/flasher-toastr-laravel


==============================================================================================
Role and permission:
https://www.itsolutionstuff.com/post/laravel-9-user-roles-and-permissions-tutorialexample.html

1) Install saptie package: - composer require spatie/laravel-permission
2) Publish vendor: - php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
3) Run migration: - php artisan migrate
4) Create necessary models
5) Add this in app/Http/Kernel.php:
	protected $routeMiddleware = [
	    ....
	    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
	    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
	    'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
	]
6) Web.php :
	Route::prefix('admin')->name('admin.')->group(function() {  // route prefix name group
		Route::group(['middleware' => 'auth:Admin'], function () {   // check middelware with auth Admin guard
			Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');   // define routes
		}) 
	})
7) Create Seeder For Permissions and AdminUser:
	- Before add guard we need to add guard in auth.php file
	- php artisan make:seeder PermissionTableSeeder
		- $permissions = ['role-list'];  // define permission name
      
	        foreach ($permissions as $permission) {
	             Permission::create(["guard_name" => "Admin", "name" => $permission]);   // create permission with guard name and it will add in "permissions" table, by default it will add web guard
	        }
        - php artisan db:seed --class=PermissionTableSeeder    // run permissions seeder
    - php artisan make:seeder CreateAdminUserSeeder
		- 	$user = User::create([
	            'name' => 'Hardik Savani', 
	            'email' => 'admin@gmail.com',
	            'password' => bcrypt('123456')
	        ]);
	      
	        $role = Role::create(["guard_name" => "Admin", "name" => "superAdmin"]);   // Role name with guard name, it will add in "roles" tables, you can add category also
	        $permissions = Permission::pluck('id', 'id')->all();    // get all permissions ids for superadmin only from 'permissions' tables
	        $role->syncPermissions($permissions);  // remove all current permission and assign new permissions
	        $user->assignRole([$role->id]);   //  assign role and permission in "role_has_permissions" table
	    - php artisan db:seed --class=CreateAdminUserSeeder    // run Admin seeder

==============================================================================================
toastr
https://github.com/yoeunes/toastr


==============================================================================================
Upload Laravel Job Batching | Upload million records:
https://www.youtube.com/watch?v=aYpPswG1Op8&list=PLe30vg_FG4OTrILM1C9NvCgujTRKGsAwB&index=1

1) For generate Queue tables with migration and then run migrate
php artisan queue:table  ->  it will generate job table

2) in .env define
QUEUE_CONNECTION=database

3) we will generate job using command
php artisan make:job StudentInsertJob 
					  {JobName}
	- It will generate job file in app/Job 

// START : for single job generate
4) for call job and discpatch in controller
	- StudentInsertJob::dispatch($student_data)->onQueue('database');		 // you can pass parameters as you need

5) I've passes $student_data then access in Job file like this
	- define protected $student_data;
	- in __construct($student_data)() {
		$this->student_data = $student_data;  // in handle() method you can directly use $this->student_data, we are adding code of insert data in handle method
	}
// END : for single job generate


// START : multiple job generate using job chaining
6) in Controller 
	Bus::chain([
	    new StudentInsertJob($student_data),  // job names comma separate, // you can pass parameters as you need
	])->dispatch()->onConnection('database');   // using ->onConnection('database') we are specifiying job connection
// END : multiple job generate using job chaining


// START : run multiple job generate using job batching
7) generate Batch tables 
	- php artisan queue:batches-table -> this will generate job_batches table then run migration
	- For use Batchable job define use Batchable in job file
	- we can dispatch batch job like this:
		- $batch = Bus::batch([
		    new StudentInsertJob($student_data),  // job names comma separate, you can pass parameters as you need
		])->name('Import Student CSV')->dispatch();  // we can define batch name also and it will show in batch table
		- if we need to add dynamic jobs then first we can generate blank jobs
			- $batch= Bus::batch([])->name('Import Student CSV')->dispatch();   // we can define batch name also and it will show in batch table, this will generate default queue
			- $batch= Bus::batch([])->name('Import Student CSV')->onConnection('database')->onQueue('importStudents')->dispatch(); // this will generate importStudents named queue
			- then we can assign job using $batch , we can use it for chunking of data, we can use it in loops for chunk of $student_data
				- $student_chunks = array_chunk($get_student_data, 50); then make loop of $student_chunks
				- $batch->add(new StudentInsertJob($all_student_data);

// END : run multiple job generate using job batching

8) we can find batch using batchID 
	- $batch = Bus::findBatch($batchId);

9) run Queue : php artisan queue:work, php artisan queue:listen  // this will run default queue
10) run queue using queue name : php artisan queue:listen --queue=importStudents


==============================================================================================
Laravel Mailable step using markdown:
1) generate mailable for perticular mail: php artisan make:mail StudentLoginEmail --markdown=admin.emails.student_login   // markdown will be view file path = 	view->admin->emails->view_file_name
-> markdown will automatically generate blade file to added path
-> mailable mail file whole structure

public $studnet_data;
public function __construct($studnet_data)
{
    $this->studnet_data = $studnet_data;
}

public function envelope(): Envelope
{
    return new Envelope(
        from: config('app.name'),  // we can show from name
        subject: 'Student Login Credentials',  // we can pass subject
    );
}

public function content(): Content
{
    return new Content(
        markdown: 'admin.emails.student_login',   // this will be view file path
        with: [
            'studnet_data' => $this->studnet_data,   // pass those variables which you want to access in view file
        ]
    );
}

2) call mailable and pass neccessary data :
->  Mail::to("email id")->cc(['email_id', 'email_id'])->send(new StudentLoginEmail($student_data));

3) for see whole mail content in HTML, we can render email:
-> Mail::to("email id")->cc(['email_id', 'email_id'])->send(new StudentLoginEmail($student_data))->render();

4) for preview mail
-> return new StudentLoginEmail($event->student_data);


==============================================================================================
Event & Listeners:
1) All the events or listeners will be listed in EventServiceProvider 
	- If we need to generate already added events or listeners then run command -> php artisan event:generate
2) Generate event -> php artisan make:event eventName
3) Generate Listener -> php artisan make:listener ListnerName --event=eventName  // generate listner for particular event using "--event=eventName"
4) in EventServiceProvider register event or listener in boot method
	- Event::listen(
        Eventname::class,
        ListnerName::class,
    );
5) List all events : php artisan event:list
6) Event : StudentAdded
	- public $student_data;  // passed variable
	- use that varialbe like this:
		public function __construct($student_data)
	    {
	        $this->student_data = $student_data;
	    }
7) Listener : SendLoginDetailEmails
	- In Handle method add your code for perform functionality
		public function handle(StudentAdded $event)   // using event object you can access variables which are passed from listner call using dispatch event
	    {
	        Mail::to($event->student_data->email)->send(new StudentLoginEmail($event->student_data));
	    }
8) dispatch event and call the listner :
	- event(new StudentAdded($student));



==============================================================================================
Command or Cron:
1) create command:
	- php artisan make:command RemoveOldImportStudentResponse  // this will automatically create signature from command name
2) in handle method add code for your functionality.
3) Run command using signature:
	- php artisan remove_old_import_student_response


=============================================================================================
Yajara single row filter apply

This will work only on this 
Store::orderBy('ordering', 'asc');

->filterColumn('created_at_date', function ($query, $keyword) {
    $query->whereRaw("DATE_FORMAT(super_admin_commissions.created_at, '%Y-%m-%d') LIKE ?", ["%$keyword%"]);
})


==============================================================================================
youtuber: for laravel
https://www.youtube.com/@ProgrammingExperience

==============================================================================================

Web Socket:
https://beyondco.de/docs/laravel-websockets/getting-started/introduction

Youtuber : laravel web socket
	- https://www.youtube.com/@ProgrammingExperience

https://tomoehlrich.com/blog/building-a-real-time-chat-demo-app-with-laravel-websockets-part-1/
1) web socket all things, everything about channel/broadcasting
	- https://www.youtube.com/watch?v=seI6FjfzqjI&list=PLQDioScEMUhl_vDV7BcYTUdTU4Jz8g58X&ab_channel=ProgrammingExperience
	- Demo dynamic chat application - https://www.youtube.com/watch?v=z_u2Zbl6LV8&list=PLQDioScEMUhl71MACSyznwoK7iOHIfuoc&index=2&ab_channel=ProgrammingExperience
	- https://www.youtube.com/watch?v=epA5BX_bZRQ&list=PL_ftyCsXJUO5n_vN0f2UFwt3UYRnrNOid&ab_channel=Maniruzzaman-Akash

1) install package:
 	- composer require beyondcode/laravel-websockets "*" 
	- If above will not work then -> composer require beyondcode/laravel-websockets "*" --ignore-platform-req=ext-gd --ignore-platform-req=ext-zip --with-all-dependencies
	- publish the migration file : php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"
	- Run the migrations : php artisan migrate
	- publish the WebSocket configuration file : php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config" 
		- It will generate config/websockets.php file.
2) Install pusher 
	- composer require pusher/pusher-php-server "~3.0" / composer require pusher/pusher-php-server "*"
	- In .env : BROADCAST_DRIVER=pusher
				PUSHER_APP_ID=1815012
				PUSHER_APP_KEY=1f3e6fb0856ef3ae2b4e
				PUSHER_APP_SECRET=8fed3ea1368da3ec9fee
				PUSHER_APP_CLUSTER=ap2
				PUSHER_HOST=127.0.0.1
				PUSHER_PORT=6001
				PUSHER_SCHEME=http

				VITE_APP_NAME="${APP_NAME}"
				VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
				VITE_PUSHER_HOST="${PUSHER_HOST}"
				VITE_PUSHER_PORT="${PUSHER_PORT}"
				VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
				VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
	- broadcasting.php  :
		'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true, // use true if site is local else remove it
                'host' => "127.0.0.1",
                'port' => env('PUSHER_PORT', 6001),
                'scheme' => 'http', // if local then use http, if live then use https
                // 'encrypted' => true,   // use true if site is live, if local then remove this
            ]
        ],
3) Run optimize and cache clear commands
4) You can see your default path for websocket which is web socket dashborad
	- after URL add "/laravel-websockets"
5) We need to install npm
	- install node
	- npm install -> first install npm
6) Install laravel-echo and pusher-js
	- npm install --save-dev laravel-echo pusher-js -> --save-dev because we can run using npm run dev, if we use --save-dev then it will work only for local
	- If by mistack used --save-dev
		- then from package.json file remove "vite" : ""
7) In resources/js/bootstrap.js
	import Echo from 'laravel-echo';
	import Pusher from 'pusher-js';

	window.Pusher = Pusher;
	// Pusher.logToConsole = true;
	window.Echo = new Echo({
	    broadcaster: 'pusher',
	    key: import.meta.env.VITE_PUSHER_APP_KEY,
	    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
	    forceTLS: false,   // use true if live
	    wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
	    wsPort: 6001,
	    disableStats: true,
	    authEndpoint: 'broadcasting/auth',
	    auth: {
	        headers: {
	            Authorization: 'Bearer {{ csrf_token() }}',
	        }
	    }
	});
8) for private and presence channel add in your controller according to your auth route in bootstrap.js file:
	/**
    * @name authenticate()
    * @uses If we need to use presence and pricate channel then we need to do this authentication step
    * @author PALAK
    */
    public function authenticate(Request $request)
    {
        $user = Auth::guard('Admin')->user(); // Adjust guard name if necessary
        $socket_id = $request->input('socket_id');
        $channel_name = $request->input('channel_name');

        if (!$user) {
            return response('Forbidden', 403);
        }

        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'useTLS' => true
            ]
        );

        $auth = null;

        if (strpos($channel_name, 'private-') === 0) {
            $auth = $pusher->socket_auth($channel_name, $socket_id);
        } else {
            $auth = $pusher->presence_auth($channel_name, $socket_id, $user->id, $user);
        }

        return response($auth);
    }


9) in web.php, define that route: 
	- For use private channel, presence channel in app.php uncomment this - // App\Providers\BroadcastServiceProvider::class,
	class BroadcastServiceProvider extends ServiceProvider
	{
	    /**
	     * Bootstrap any application services.
	     */
	    public function boot(): void
	    {
	        Broadcast::routes(['middleware' => ['auth:Admin']]);

	        require base_path('routes/channels.php');
	    }
	}

	Route::prefix('admin')->name('admin.')->group(function () {
	    Route::group(['middleware' => 'auth:Admin'], function () {        
	        Route::post('broadcasting/auth', [ChatController::class, 'authenticate']);   
	});
10) chat.js
	download

11) php artisan websockets:serve
12) npm run dev
13) use @vite('resources/js/app.js') in script
14) in Event we should use implements ShouldBroadcastNow for broadcast event with web socket


Whole demo for chat demo : https://github.com/baashna514/Laravel-Dynamic-Chat-Application-Using-Websockets/tree/main

=================================================================================================
BroadCast:
- there are 3 types of channel
	- public, private, Presence
- We can run broadcast like this 
	- broadcast (new \App\Events\TradeEvent("Hello, Good noon"))
	- this will work in sync
- public channel
	- in public channel we will define var as public
	- generate channel using Channel()
- Private Channel
	- this channel will use only with authenticated user
	- we will define var as private or public
	- generate channel using PrivateChannel()
	- For use private channel, presence channel in app.php uncomment this - // App\Providers\BroadcastServiceProvider::class,
	- We need to broadcast channel in channel.php
- Presence Channel
	- define var as public
	- generate channel using PresenceChannel()
- Change name of event
	- use function broadcastAs() {
		return 'changed-name';
	}
	- Listen that changed event name using - listen('.changed-name')

 window.Echo.join('status-update')
    .here((users) => {
        console.log("total users : ", users)
        users.forEach(user => {
            if (sender_id != user.id) {
                $('#status-' + user.id).addClass('online');
            }
        });
    })
    .joining((user) => {
        console.log(user.name + ' ' + user.id + ' joined')
        $('#status-' + user.id).addClass('online');
        $('.single_status_' + user.id).html('Online');
        $('.single-img-user').addClass('online');
    })
    .leaving((user) => {
        console.log(user.name + ' ' + user.id + ' leaving')
        $('#status-' + user.id).removeClass('online');
        $('.single_status_' + user.id).html('Offline');
        $('.single-img-user').removeClass('online');
    })
    .listen('UserStatusEvent', (e) => {
        console.log(e)
    })
    .error((error) => {
        console.error('Pusher error:', error);
    });

window.Echo.private('typing-channel')
    .listen('TypingEvent', (event) => {
        if(event.receiver_id != 0) {
            if(sender_id == event.receiver_id && event.is_typing == "true") {
                $('#typing-status-' + event.sender_id).addClass('typing_indicator')
            } else {
                $('#typing-status-' + event.sender_id).removeClass('typing_indicator')
            }
        }

        if(event.group_id != 0 && sender_id != event.sender_id) {
            if(event.is_typing == "true") {
                $('#group-typing-status-' + event.group_id).addClass('typing_indicator')
            } else {
                $('#group-typing-status-' + event.group_id).removeClass('typing_indicator')
            }
        }
    });

=====================================================================================
Convert database string to HTML : {!!  !!}

In Laravel (as of my last update), the {!! !!} syntax in Blade templates is used to output content without escaping. This means that any HTML tags or special characters within the content will be rendered as HTML on the page.


=====================================================================================
Laravel real time notification
https://www.youtube.com/watch?v=3PZ8tn7nbQY&ab_channel=ProgrammingExperience
https://www.youtube.com/watch?v=FPRwQxtANzc&ab_channel=Ajayyadav

Audio play for notification
<audio><source src="" type="audio/mpeg"></audio>

var noti = document.getElementById('audio_file');
function enableAutoPlay () {
	noti.autoplay = true;
	noti.load();
}

1) Mail notification:
- php artisan make:notification AdminLogin
- we can implement ShouldQueue and don't forget to "php run artisan queue:listen" command
- $admin->notify(new AdminLogin($admin_data));
- public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
           ->line('Dear ' . $this->admin_data['name'] . ', This is your login credentials.')
           ->line('Email : ' . $this->admin_data['email'])
           ->line('Password : ' . $this->admin_data['password'])
           ->line('Thank you for using our application!');
    }
- we can use markdown : php artisan make:notification AdminLogin --markdown=admin.emails.admin_login
	public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Invoice Paid')
            ->markdown('admin.emails.admin_login', ['data' => $this->data]);   // pass variables
    }
- using mailalble:
	public function toMail(object $notifiable): Mailable
    {
        return (new StudentLoginEmail($this->admin_data))->to($notifiable->email);
    }

2) Database notification:
- php artisan notifications:table
- php artisan migrate
- in controller add notification : $admin =  Admin::find($admin_id);
	        $notification_data = [
	            'message' => auth()->user()->name . ' Added you to the group ' . $group->name . '"',
	            'image' => !empty(auth()->user()->image) ? auth()->user()->image : 'default_avatar.png',
	        ];
	        $admin->notify(new UserAddedGroup($notification_data));
- Notification class - https://prnt.sc/gfhLdFAKE0id
- Access : https://prnt.sc/tePRDnqku8ja
- Read notification - https://prnt.sc/r9oUxRvFpNnS	        	    
  

====================================================================================================
Left join with multiple ANDs

$transactions = PaymentTransaction::select(
    'payment_transactions.id',
    'payment_transactions.event_id',
    'payment_transactions.user_id',
    'payment_transactions.user_type',
    DB::raw('CASE payment_transactions.user_type 
                WHEN "BrideAndGroom" THEN bride_grooms.first_name
                WHEN "Vendor" THEN vendors.name
                ELSE "" 
            END AS user_name')

)
->leftJoin('bride_grooms', function($join) {
    $join->on('bride_grooms.id', '=', 'payment_transactions.user_id')
         ->where('payment_transactions.user_type', '=', 'BrideAndGroom');
})
->leftJoin('vendors', function($join) {
    $join->on('vendors.id', '=', 'payment_transactions.user_id')
         ->where('payment_transactions.user_type', '=', 'Vendor');
})
->get();


==============================================================================================================
For connection in pgsql
first install postgreSQL
- default user of pgsql is postgres
- when you open pgadmin for the first time it will ask for set password for pgadmin user
- then set enviornment variable for pdadmin and path - C:\Program Files\PostgreSQL\17\bin 
- in php.ini file remove # from extension=pgsql and extension=pdo_pgsql
- restart the apache server
- in CMD type php -m | findstr pgsql then it will show that uncommented extension  (pgsql and pdo_pgsql)
- you can change password using this command psql -U postgres -W, ALTER USER postgres WITH PASSWORD 'your_new_password';
- You can run migration and seeder


