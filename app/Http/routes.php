<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/auth/login', ['uses'=>'LoginController@create','as'=>'loginCreate.create']);
Route::post('/auth/login', 'LoginController@checkLogin');
Route::group(['middleware' => ['beforelogin','token']], function () {
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

        Route::get('/', 'DashboardController@index');

        // profile
        Route::get('/profile', ['uses'=>'ProfileController@index', 'as'=>'profile.index']);
        Route::post('/profile-create', ['uses'=>'ProfileController@create', 'as'=>'profile.create']);

        // jabatan


        Route::get('/error', 'DashboardController@privilege');

        /*Frontend Manager*/
        Route::get('/fe', 'Fe@index');
        Route::post('/fe', 'Fe@edit');

         /*Admin user*/
        Route::get('/user', 'User@index');
        Route::get('/user/add', 'User@add');
        Route::post('/user/add', 'User@addProcess');
        Route::get('/user/edit/{id}', 'User@edit');
        Route::post('/user/edit/{id}', 'User@editProcess');
        Route::get('/user/delete/{id}', 'User@delete');

        /*Admin user level*/
        Route::get('/user_level', 'User@indexLevel');
        Route::get('/user_level/add', 'User@addLevel');
        Route::post('/user_level/add', 'User@addProcessLevel');
        Route::get('/user_level/edit/{id}', 'User@editLevel');
        Route::post('/user_level/edit/{id}', 'User@editProcessLevel');
        Route::get('/user_level/delete/{id}', 'User@deleteLevel');

        /*Admin carousel*/
        Route::get('/carousel', 'Carousel@index');
        Route::get('/carousel/add', 'Carousel@add');
        Route::post('/carousel/add', 'Carousel@addProcess');
        Route::get('/carousel/edit/{id}', 'Carousel@edit');
        Route::post('/carousel/edit/{id}', 'Carousel@editProcess');
        Route::get('/carousel/delete/{id}', 'Carousel@delete');

        /*Admin Menu*/
        Route::get('/menu', 'Menu@index');
        Route::get('/menu/add', 'Menu@add');
        Route::post('/menu/add', 'Menu@addProcess');
        Route::get('/menu/edit/{id}', 'Menu@edit');
        Route::post('/menu/edit/{id}', 'Menu@editProcess');
        Route::get('/menu/delete/{id}', 'Menu@delete');

        /*Admin Post*/
        Route::get('/post', 'Post@index');
        Route::get('/post/add', 'Post@add');
        Route::post('/post/add', 'Post@addProcess');
        Route::get('/post/edit/{id}', 'Post@edit');
        Route::post('/post/edit/{id}', 'Post@editProcess');
        Route::get('/post/delete/{id}', 'Post@delete');
        Route::get('/post/setting', 'Post@setting');
        Route::post('/post/setting', 'Post@settingProcess');

        /*Admin Media Manager*/
        Route::get('/mediamanager', 'MediaManager@index');
        Route::post('/mediamanager/deletegroup', 'MediaManager@deletegroup');
        Route::get('/mediamanager/delete/{id}', 'MediaManager@delete');
        Route::get('/mediamanager/show', ['as' => 'show', 'middleware' => 'ajaxOnly', 'uses' => 'MediaManager@show']);

        /*Admin Process*/
        Route::get('/process_text', 'Process_text@index');
        Route::get('/process_text/add', 'Process_text@add');
        Route::post('/process_text/add', 'Process_text@addProcess');
        Route::get('/process_text/edit/{id}', 'Process_text@edit');
        Route::post('/process_text/edit/{id}', 'Process_text@editProcess');
        Route::get('/process_text/delete/{id}', 'Process_text@delete');
        Route::get('/process_text/setting', 'Process_text@setting');
        Route::post('/process_text/setting', 'Process_text@settingProcess');

        /*Admin Project*/
        Route::get('/project', 'Project@index');
        Route::get('/project/category', 'Project@category');
        Route::get('/project/category/add', 'Project@categoryAdd');
        Route::post('/project/category/add', 'Project@categoryAddProcess');
        Route::get('/project/category/edit/{id}', 'Project@editCategory');
        Route::post('/project/category/edit/{id}', 'Project@editCategoryProcess');
        Route::get('/project/category/delete/{id}', 'Project@deleteCategory');
        Route::get('/project/add', 'Project@add');
        Route::post('/project/add', 'Project@addProcess');
        Route::get('/project/edit/{id}', 'Project@edit');
        Route::post('/project/edit/{id}', 'Project@editProcess');
        Route::get('/project/delete/{id}', 'Project@deleteProject');
        Route::get('/project/setting', 'Project@setting');
        Route::post('/project/setting', 'Project@settingProcess');


        /*Admin Skill*/
        Route::get('/skill', 'Skill@index');
        Route::get('/skill/add', 'Skill@add');
        Route::post('/skill/add', 'Skill@addProcess');
        Route::get('/skill/edit/{id}', 'Skill@edit');
        Route::post('/skill/edit/{id}', 'Skill@editProcess');
        Route::get('/skill/delete/{id}', 'Skill@delete');
        Route::get('/skill/setting', 'Skill@setting');
        Route::post('/skill/setting', 'Skill@settingProcess');

        /*Admin Team */
        Route::get('/team', 'Team@index');
        Route::get('/team/add', 'Team@addPerson');
        Route::post('/team/add', 'Team@addPersonProcess');
        Route::get('/team/edit/{id}', 'Team@editPerson');
        Route::post('/team/edit/{id}', 'Team@editPersonProcess');
        Route::get('/team/delete/{id}', 'Team@delete');
        Route::get('/team/setting', 'Team@setting');
        Route::post('/team/setting', 'Team@settingProcess');

        /*Admin Testimonial*/
        Route::get('/testimonial', 'Testimonial@index');
        Route::get('/testimonial/add', 'Testimonial@addView');
        Route::post('/testimonial/add', 'Testimonial@addProcess');
        Route::get('/testimonial/edit/{id}', 'Testimonial@edit');
        Route::post('/testimonial/edit/{id}', 'Testimonial@editProcess');
        Route::get('/testimonial/delete/{id}', 'Testimonial@delete');
        Route::get('/testimonial/setting', 'Testimonial@setting');
        Route::post('/testimonial/setting', 'Testimonial@settingProcess');

        /*Admin Contact */
        Route::post('/contact', 'contact@edit');
        Route::get('/contact', 'contact@index');

        /*Admin Setting */
        Route::get('/setting', 'Setting@index');
        Route::post('/setting', 'Setting@generalProcess');
        Route::get('/setting/location', 'Setting@location');
        Route::post('/setting/location', 'Setting@locationProcess');
        Route::get('/setting/footer', 'Setting@footer');
        Route::post('/setting/footer', 'Setting@footerProcess');
        Route::get('/setting/footer/social', 'Setting@social');
        Route::post('/setting/footer/social', 'Setting@socialProcess');
        Route::get('/setting/profile', 'Setting@profile');
        Route::post('/setting/profile', 'Setting@profileProcess');


        /*Admin Guest Book*/
        Route::get('/guest_book', 'guest_book@index');
        Route::get('/guest_book/delete/{id}', 'guest_book@delete');
        Route::get('/guest_book_read/{id}', 'guest_book@read');

        /*Admin Log Out*/
        Route::get('/logout', 'DashboardController@logout');

        /*Admin Menu*/
        Route::get('/config/menu', ['uses'=>'ConfigController@menu', 'as'=>'config.menu']);
        Route::post('/config/menu-save', ['uses'=>'ConfigController@menuSave', 'as'=>'config.menuSave']);
        Route::post('/config/menu-edit', ['uses'=>'ConfigController@menuUpdate', 'as'=>'config.menuUpdate']);
        Route::get('/config/menu-delete', ['uses'=>'ConfigController@menuDestroy', 'as'=>'config.menuDestroy']);
        Route::get('/config/menu-all', ['uses'=>'ConfigController@menuShowAll', 'as'=>'config.menuShowAll']);
        Route::get('/config/menu-icon', ['uses'=>'ConfigController@menuIcon', 'as'=>'config.menuIcon']);



        // config role
        Route::get('/config/role', ['uses'=>'ConfigController@configRole', 'as'=>'config.role']);
        Route::get('/role-reload-menu', ['uses'=>'ConfigController@reloadMenu', 'as'=>'config.reloadMenu']);
        Route::post('/role-edit-group', ['uses'=>'ConfigController@editRole', 'as'=>'config.editGroup']);
        // config role

        // config group
        Route::get('/config/group', ['uses'=>'ConfigController@menuGroup', 'as'=>'config.menuGroup']);
        Route::post('/config/group-save', ['uses'=>'ConfigController@groupSave', 'as'=>'config.groupSave']);
        Route::get('/config/group-show', ['uses'=>'ConfigController@groupShow', 'as'=>'config.groupShow']);
        Route::post('/config/group-edit', ['uses'=>'ConfigController@groupEdit', 'as'=>'config.groupEdit']);
        Route::get('/config/group-delete', ['uses'=>'ConfigController@groupDelete', 'as'=>'config.groupDelete']);
        // config group

        // save obligation
        Route::get('/simpanan/wajib', ['uses'=>'SaveControllers@wajibList', 'as'=>'config.wajibList']);
        Route::post('/simpanan/wajib-save', ['uses'=>'SaveControllers@wajibSave', 'as'=>'config.wajibSave']);

        Route::get('/simpanan/list', ['uses'=>'SaveControllers@listSave', 'as'=>'config.listSave']);


        Route::get('/simpanan/pokok', ['uses'=>'SaveControllers@pokokList', 'as'=>'config.pokokList']);
        Route::post('/simpanan/pokok-save', ['uses'=>'SaveControllers@pokokSave', 'as'=>'config.pokokSave']);



        Route::get('/keuangan', ['uses'=>'KeuanganController@keuanganKoprasi', 'as'=>'config.keuanganKoprasi']);

        Route::get('/anggota', ['uses'=>'AnggotaController@generateTokenAnggota', 'as'=>'config.generateTokenAnggota']);
        Route::post('/anggota-generate', ['uses'=>'AnggotaController@generateToken', 'as'=>'config.generateToken']);

    });
});



Route::group(['namespace' => 'Frontend', 'prefix' => '/'], function () {
    // Route::resource('event', 'EventController');
    Route::get('/', [
      'uses' => 'WelcomeController@index'
    ]);

    Route::get("/project/{id}","WelcomeController@projectShow");
    Route::get("/project","WelcomeController@project");
    Route::get("/blog/{id}","WelcomeController@postShow");
    Route::get("/blog","WelcomeController@post");
    Route::post("/pesan","WelcomeController@message");
});
