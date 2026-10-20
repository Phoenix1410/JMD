<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

//==== Admin route==//
Route::group(['namespace' => '\App\Http\Controllers\Admin'], function () {
    Route::post('unlock-screen', ['uses' => 'AdminController@postUnlockScreen', 'as' => 'postUnlockScreen']);
    Route::get('lock-screen', ['uses' => 'AdminController@getLockscreen', 'as' => 'getLockScreen']);
    Route::post('forgot', ['uses' => 'AdminController@postForgot', 'as' => 'postForgot']);
    Route::get('forgot', ['uses' => 'AdminController@getForgot', 'as' => 'getForgot']);
    Route::post('register', ['uses' => 'AdminController@postRegister', 'as' => 'postRegister']);
    Route::get('register', ['uses' => 'AdminController@getRegister', 'as' => 'getRegister']);
    Route::get('logout', ['uses' => 'AdminController@getLogout', 'as' => 'getLogout']);
    Route::post('login', ['uses' => 'AdminController@postLogin', 'as' => 'postLogin']);
    Route::get('login', ['uses' => 'AdminController@getLogin', 'as' => 'getLogin']);
   
});

Route::group(['middleware' => ['admin.auth'], 'namespace' => '\App\Http\Controllers\Admin'], function () {
    // Route::redirect('/', '/admin/dashboard');
    Route::get('/', ['uses' => 'AdminController@getIndex', 'as' => 'getIndex']);
    Route::get('/dashboard', ['uses' => 'AdminController@getIndex', 'as' => 'getAdminDashboard']);
    Route::get('/dashboard', ['uses' => 'AdminController@getIndex', 'as' => 'getAdminProfile']);
     //Menu Management
     Route::get('menu-management', ['uses'=>'MenusController@getIndex', 'as'=>'getMenus']);
     Route::post('menu-management/add-save-menu', ['uses'=>'MenusController@postAddSave', 'as' => 'postAddMenu']);
     Route::get('menu-management/edit/{id}', ['uses'=>'MenusController@editMenu', 'as' => 'getEditMenu']);
     Route::get('menu-management/delete/{id}', ['uses'=>'MenusController@deleteMenu', 'as' => 'deleteMenu']);
     Route::post('menu-management/edit-save-menu/{id}', ['uses'=>'MenusController@postUpdateSave', 'as' => 'postUpdateMenu']);

     //CMS Management
    Route::get('manage-cms', ['uses' => 'ManageCMSController@getIndex', 'as' => 'getManageCMS']);
    Route::get('manage-cms/add', ['uses' => 'ManageCMSController@getAdd', 'as' => 'getAddCms']);
    Route::post('manage-cms/add-save-cms', ['uses' => 'ManageCMSController@postAddSave', 'as' => 'postAddCms']);
    Route::get('manage-cms/detail/{id}', ['uses' => 'ManageCMSController@getDetail', 'as' => 'getDetailCms']);
    Route::get('manage-cms/edit/{id}', ['uses' => 'ManageCMSController@getEdit', 'as' => 'getEditCms']);
    Route::post('manage-cms/edit-save-cms/{id}', ['uses' => 'ManageCMSController@postUpdateSave', 'as' => 'postUpdateCms']);
    Route::get('manage-cms/delete/{id}', ['uses' => 'ManageCMSController@getDelete', 'as' => 'deleteCms']);
    Route::post('manage-cms/action-selected', ['uses' => 'ManageCMSController@postActionSelected', 'as' => 'actionSelectedCms']);

     //Admin Users
    Route::get('admin-users', ['uses'=>'AdminUsersController@getIndex', 'as'=>'getAdminUsers']);
    Route::get('admin-users/add', ['uses'=>'AdminUsersController@getAdd', 'as'=>'getAddAdminUser']);    
    Route::post('admin-users/add-save', ['uses'=>'AdminUsersController@postAddSave', 'as'=>'postAddSaveAdminUser']);
    Route::get('admin-users/edit/{id}', ['uses'=>'AdminUsersController@getEdit', 'as'=>'getEditAdminUser']);
    Route::post('admin-users/update-save/{id}', ['uses'=>'AdminUsersController@postUpdateSave', 'as'=>'postUpdateSaveAdminUser']);
    Route::get('admin-users/delete/{id}', ['uses'=>'AdminUsersController@getDelete', 'as'=>'getDeleteAdminUser']);
    
     //Privileges
     Route::get('privileges', ['uses'=>'MenusController@getPrivilege', 'as'=>'getPrivilege']);
     Route::get('privileges/add', ['uses'=>'MenusController@getAddPrivilege', 'as'=>'getAddPrivilege']);
     Route::post('privileges/add-save-privilege', ['uses'=>'MenusController@postAddPrivilege', 'as'=>'postAddPrivilege']);
     Route::get('privileges/edit/{id}', ['uses'=>'MenusController@getEditPrivilege', 'as'=>'getEditPrivilege']);
     Route::get('privileges/delete/{id}', ['uses'=>'MenusController@getDeletePrivilege', 'as'=>'getDeletePrivilege']);
     Route::post('privileges/edit-save-privilege/{id}', ['uses'=>'MenusController@postUpdatePrivilege', 'as'=>'postUpdatePrivilege']);

     //Settings
    Route::get('general-settings', ['uses' => 'SettingsController@getGeneralSettings', 'as' => 'getGeneralSettings']);
    Route::post('general-settings/save-general-settings', ['uses' => 'SettingsController@postSaveGeneralSettings', 'as' => 'postSaveGeneralSettings']);
    Route::get('email-settings', ['uses' => 'SettingsController@getEmailSettings', 'as' => 'getEmailSettings']);
    Route::post('email-settings/save', ['uses' => 'SettingsController@postSaveEmailSettings', 'as' => 'postSaveEmailSettings']);
    Route::get('homepage-settings', ['uses'=>'SettingsController@getHomeSettings', 'as'=>'getHomeSettings']);
    Route::post('homepage-settings/save', ['uses'=>'SettingsController@postSaveHomeSettings', 'as'=>'postSaveHomeSettings']);

    //Download & Delete File
    Route::get('download-file', 'AdminController@download_file');
    Route::get('delete-image', 'AdminController@delete_file');

    //admin profile
    Route::get('profile', ['uses' => 'ProfileController@getProfileData', 'as' => 'getProfileData']);
    Route::post('save-profile', ['uses' => 'ProfileController@postSaveProfile', 'as' => 'postSaveProfile']);

     //Notification
    Route::get('notifications', ['uses'=>'NotificationController@getIndex'])->name('admin.notification');
    Route::get('notifications/read/{id}', ['uses'=>'NotificationController@readNotification'])->name('admin.read_notification');
    Route::get('notifications/delete/{id}', ['uses'=>'NotificationController@deleteNotification'])->name('admin.delete_notification');
    Route::post('notifications/action-selected', ['uses'=>'NotificationController@postActionSelected'])->name('admin.action_selected_notification');


    //Manage Email templates
    Route::get('email-templates', ['uses' => 'ManageEmailTemplates@getIndex', 'as' => 'getIndexEmailTemplate']);
    Route::get('email-templates/add', ['uses' => 'ManageEmailTemplates@getAdd', 'as' => 'addEmailTemplate']);
    Route::post('add-save-email-templates', ['uses'=>'ManageEmailTemplates@postAddSave', 'as' => 'postAddEmailTemplate']);
    Route::get('email-templates/detail/{id}', ['uses' => 'ManageEmailTemplates@getDetail', 'as' => 'getDetailEmailTemplate']);
    Route::get('email-templates/edit/{id}', ['uses' => 'ManageEmailTemplates@getEdit', 'as' => 'getEditEmailTemplate']);
    Route::post('edit-save-email-templates/{id}', ['uses' => 'ManageEmailTemplates@postUpdateSave', 'as' => 'postUpdateEmailTemplate']);
    Route::get('email-templates/delete/{id}', ['uses' => 'ManageEmailTemplates@deleteDuration', 'as' => 'deleteManageEmailTemplate']);
   
    //Manage NewsRoll
    Route::get('Newsletter', ['uses' => 'ManageNewsRoll@getIndex', 'as' => 'managenewsroll']);
    Route::get('Newsletter/add', ['uses' => 'ManageNewsRoll@getAdd', 'as' => 'addnewsroll']);
    Route::post('add-save-Newsletter', ['uses'=>'ManageNewsRoll@postAddSave', 'as' => 'postAddnewsroll']);
    Route::get('Newsletter/detail/{id}', ['uses' => 'ManageNewsRoll@getDetail', 'as' => 'getDetailnewsroll']);
    Route::get('Newsletter/edit/{id}', ['uses' => 'ManageNewsRoll@getEdit', 'as' => 'getEditnewsroll']);
    Route::post('edit-save-Newsletter/{id}', ['uses' => 'ManageNewsRoll@postUpdateSave', 'as' => 'postUpdatenewsroll']);
    Route::get('Newsletter/delete/{id}', ['uses' => 'ManageNewsRoll@getDelete', 'as' => 'deleteManagenewsroll']);
    //Manage Job list
    Route::get('joblist', ['uses' => 'ManageJoblist@getIndex', 'as' => 'joblist']);
    Route::get('joblist/add', ['uses' => 'ManageJoblist@getAdd', 'as' => 'addjoblist']);
    Route::post('add-save-joblist', ['uses'=>'ManageJoblist@postAddSave', 'as' => 'postAddjoblist']);
    Route::get('joblist/detail/{id}', ['uses' => 'ManageJoblist@getDetail', 'as' => 'getDetailjoblist']);
    Route::get('joblist/edit/{id}', ['uses' => 'ManageJoblist@getEdit', 'as' => 'getEditjoblist']);
    Route::post('edit-save-joblist/{id}', ['uses' => 'ManageJoblist@postUpdateSave', 'as' => 'postUpdatejoblist']);
    Route::get('joblist/delete/{id}', ['uses' => 'ManageJoblist@getDelete', 'as' => 'deleteManagejoblist']);
    //Manage Job Post
    Route::get('jobPosts', ['uses' => 'ManageJobPosts@getIndex', 'as' => 'jobPosts']);
    Route::get('jobPosts/detail/{id}', ['uses' => 'ManageJobPosts@getDetail', 'as' => 'getDetailjobPosts']);
    //Manageclients
    Route::get('manageclient', ['uses' => 'ManageClients@getIndex', 'as' => 'manageclient']);
    Route::get('manageclient/add', ['uses' => 'ManageClients@getAdd', 'as' => 'addclients']);
    Route::post('add-save-client', ['uses'=>'ManageClients@postAddSave', 'as' => 'postAddclients']);
    Route::get('manageclient/detail/{id}', ['uses' => 'ManageClients@getDetail', 'as' => 'getDetailclients']);
    Route::get('manageclient/edit/{id}', ['uses' => 'ManageClients@getEdit', 'as' => 'getEditclients']);
    Route::post('edit-save-client/{id}', ['uses' => 'ManageClients@postUpdateSave', 'as' => 'postUpdateclients']);
    Route::get('manageclient/delete/{id}', ['uses' => 'ManageClients@getDelete', 'as' => 'deleteManageclients']);
    //Manage Contactus
    Route::get('Admincontact', ['uses' => 'ManageContactUs@getIndex', 'as' => 'managecontactus']);
    Route::get('Admincontact/detail/{id}', ['uses' => 'ManageContactUs@getDetail', 'as' => 'managecontactusdetails']);
    Route::post('edit-save-Admincontact/{id}', ['uses' => 'ManageContactUs@postUpdateSave', 'as' => 'postUpdatecontactus']);
     //Manage officetype
    Route::get('officetype', ['uses' => 'ManageOfficetype@getIndex', 'as' => 'officetype']);
    Route::get('officetype/add', ['uses' => 'ManageOfficetype@getAdd', 'as' => 'addofficetype']);
    Route::post('add-save-officetype', ['uses'=>'ManageOfficetype@postAddSave', 'as' => 'postofficetype']);
    Route::get('officetype/detail/{id}', ['uses' => 'ManageOfficetype@getDetail', 'as' => 'getDetailofficetype']);
    Route::get('officetype/edit/{id}', ['uses' => 'ManageOfficetype@getEdit', 'as' => 'getEditofficetype']);
    Route::post('edit-save-officetype/{id}', ['uses' => 'ManageOfficetype@postUpdateSave', 'as' => 'postUpdateofficetype']);
    Route::get('officetype/delete/{id}', ['uses' => 'ManageOfficetype@getDelete', 'as' => 'deleteManageofficetype']);   
    //Manage Office 
    Route::get('office', ['uses' => 'ManageOffice@getIndex', 'as' => 'office']);
    Route::get('office/add', ['uses' => 'ManageOffice@getAdd', 'as' => 'addoffice']);
    Route::post('add-save-office', ['uses'=>'ManageOffice@postAddSave', 'as' => 'postoffice']);
    Route::get('office/detail/{id}', ['uses' => 'ManageOffice@getDetail', 'as' => 'getDetailoffice']);
    Route::get('office/edit/{id}', ['uses' => 'ManageOffice@getEdit', 'as' => 'getEditoffice']);
    Route::post('edit-save-office/{id}', ['uses' => 'ManageOffice@postUpdateSave', 'as' => 'postUpdateoffice']);
    Route::get('office/delete/{id}', ['uses' => 'ManageOffice@getDelete', 'as' => 'deleteManageoffice']);   
    Route::post('city-by-states', ['uses' => 'ManageOffice@getCityByState']);
       // manage aboutus contetn 
    Route::get('aboutus', ['uses' => 'Manageaboutus@getEdit', 'as' => 'manageaboutus']);
    Route::get('aboutus/add', ['uses' => 'Manageaboutus@getAdd', 'as' => 'addaboutus']);
    Route::post('add-save-aboutus', ['uses'=>'Manageaboutus@postAddSave', 'as' => 'postaboutus']);
    Route::get('aboutus/detail/{id}', ['uses' => 'Manageaboutus@getDetail', 'as' => 'getDetailaboutus']);
    // Route::get('aboutus/edit/{id}', ['uses' => 'Manageaboutus@getEdit', 'as' => 'getEditaboutus']);
    Route::post('edit-save-aboutus', ['uses' => 'Manageaboutus@postUpdateSave', 'as' => 'postUpdateaboutus']);
    Route::get('aboutus/delete/{id}', ['uses' => 'Manageaboutus@getDelete', 'as' => 'deleteManageaboutus']);   
  
    //manage state
  Route::get('manage-states', ['uses' => 'ManageStatesController@getIndex', 'as' => 'getStates']);
    Route::get('manage-states/add', ['uses' => 'ManageStatesController@getAdd', 'as' => 'getAddStates']);
    Route::post('manage-states/add-save-state', ['uses'=>'ManageStatesController@postAddSave', 'as' => 'postAddStates']);
    Route::get('manage-states/detail/{id}', ['uses' => 'ManageStatesController@getDetail', 'as' => 'getDetailStates']);
    Route::get('manage-states/edit/{id}', ['uses' => 'ManageStatesController@getEdit', 'as' => 'getEditStates']);
    Route::post('manage-states/edit-save-state/{id}', ['uses' => 'ManageStatesController@postUpdateSave', 'as' => 'postUpdateStates']);
    Route::get('manage-states/delete/{id}', ['uses' => 'ManageStatesController@getDelete', 'as' => 'deleteStates']);
    Route::post('manage-states/action-selected', ['uses' => 'ManageStatesController@postActionSelected', 'as' => 'actionSelectedStates']);
    Route::post('manage-states/status', ['uses' => 'ManageStatesController@changeStatus', 'as' => 'manage-states.status']);
    //   Route::post('manage-states/status', 
    // [\App\Http\Controllers\Admin\ManageTestimonialController::class, 'changeStatus'])->name('manage-states.status');
  
    // manage branches
    Route::get('branches', ['uses' => 'ManageBranches@getIndex', 'as' => 'managebranches']);
    Route::get('branches/add', ['uses' => 'ManageBranches@getAdd', 'as' => 'addbranches']);
    Route::post('add-save-branches', ['uses'=>'ManageBranches@postAddSave', 'as' => 'postbranches']);
    Route::get('branches/detail/{id}', ['uses' => 'ManageBranches@getDetail', 'as' => 'getDetailbranches']);
    Route::get('branches/edit/{id}', ['uses' => 'ManageBranches@getEdit', 'as' => 'getEditbranches']);
    Route::post('edit-save-branches/{id}', ['uses' => 'ManageBranches@postUpdateSave', 'as' => 'postUpdatebranches']);
    Route::get('branches/delete/{id}', ['uses' => 'ManageBranches@getDelete', 'as' => 'deleteManagebranches']);   
    Route::post('/admin/branches/upload-csv',['uses' => 'ManageBranches@uploadBranchCsv','as'=>'uploadBranchCsv']);
    Route::get('/admin/branches/sample-csv',['uses' => 'ManageBranches@downloadBranchSample','as'=>'downloadBranchSample']);
    //Country Management
    Route::get('manage-country', ['uses'=>'ManageCountry@getIndex', 'as'=>'getManageCountry']);
    Route::get('manage-country/add', ['uses'=>'ManageCountry@getAdd', 'as'=>'getAddCountry']);
    Route::post('manage-country/add-save', ['uses' => 'ManageCountry@postAddSave', 'as' => 'postAddCountry']);
    Route::get('manage-country/detail/{id}', ['uses' => 'ManageCountry@getDetail', 'as' => 'getDetailCountry']);
    Route::get('manage-country/edit/{id}', ['uses' => 'ManageCountry@getEdit', 'as' => 'getEditCountry']);
    Route::post('manage-country/edit-save/{id}', ['uses' => 'ManageCountry@postUpdateSave', 'as' => 'postUpdateCountry']);
    Route::get('manage-country/delete/{id}', ['uses' => 'ManageCountry@getDelete', 'as' => 'deleteCountry']);  
    Route::post('manage-country/action-selected', ['uses' => 'ManageCountry@postActionSelected', 'as' => 'actionSelectedCountry']);

    //City Management
    Route::get('manage-city', ['uses'=>'ManageCity@getIndex', 'as'=>'getManageCity']);
    Route::get('manage-city/add', ['uses'=>'ManageCity@getAdd', 'as'=>'getAddCity']);
    Route::post('manage-city/add-save', ['uses' => 'ManageCity@postAddSave', 'as' => 'postAddCity']);
    Route::get('manage-city/detail/{id}', ['uses' => 'ManageCity@getDetail', 'as' => 'getDetailCity']);
    Route::get('manage-city/edit/{id}', ['uses' => 'ManageCity@getEdit', 'as' => 'getEditCity']);
    Route::post('manage-city/edit-save/{id}', ['uses' => 'ManageCity@postUpdateSave', 'as' => 'postUpdateCity']);
    Route::get('manage-city/delete/{id}', ['uses' => 'ManageCity@getDelete', 'as' => 'deleteCity']);  
    Route::post('manage-city/action-selected', ['uses' => 'ManageCity@postActionSelected', 'as' => 'actionSelectedCity']); 

    // AUTO-ADMIN-ROUTES-START        
    Route::resource('testmodule', TestModuleController::class);
    Route::post('contact-address/status', 
    [\App\Http\Controllers\Admin\ContactAddressController::class, 'changeStatus'])->name('contact-address.status');
    Route::resource('contact-address', ContactAddressController::class);    
    Route::get('manage-services/status/{id}', 
    [\App\Http\Controllers\Admin\ManageServicesController::class, 'changeStatus'])->name('manage-services.status');
    Route::resource('manage-services', ManageServicesController::class);
    Route::post('manage-banner/status', 
    [\App\Http\Controllers\Admin\ManageBannerController::class, 'changeStatus'])->name('manage-banner.status');
    Route::resource('manage-banner', ManageBannerController::class);
    Route::resource('who-we-are', WhoWeAreController::class);
    Route::resource('manage-testimonial', ManageTestimonialController::class);
    // Route::post('manage-testimonial-status', 
    // [\App\Http\Controllers\Admin\ManageTestimonialController::class, 'changeStatus'])->name('manage-testimonial.status');
    Route::post('manage-newsrolls-status', 
    [\App\Http\Controllers\Admin\ManageNewsRoll::class, 'changeStatus'])->name('manage-newsrolls.status');
    Route::post('manage-testimonial-status', 
    [\App\Http\Controllers\Admin\ManageTestimonialController::class, 'changeStatus'])->name('manage-testimonial.status');
    // AUTO-ADMIN-ROUTES-END 
    Route::post('manage-branch-status', ['uses' => 'ManageBranches@changeStatus', 'as' => 'manage-branches.status']);
 Route::post('manage-joblist-status', ['uses' => 'ManageJoblist@changeStatus', 'as' => 'manage-joblist.status']);
  Route::post('manage-clients-status', ['uses' => 'ManageClients@changeStatus', 'as' => 'manage-clients.status']);

});