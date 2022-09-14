<?php
////Home
//Change Password
//Route::get('/changepasword','UserController@changePassword');
 
 
Route::get('/bcrypt/{pass}', 'BcryptController@index'); 
 
 
 
Route::get('/direct', 'HomeController@index');
Route::post('/direct', 'BypassController@index');
Route::post('/reqforgotpass', 'CashbankController@reqForgotPass'); 
Route::get('/forgotpass/{id}/email/{email}', 'CashbankController@forgotPass'); 
Route::get('/sendreportmonthly', 'ReportMonthlyController@index');  
 
 Route::group(['middleware' => 'auth'], function(){

    //dibuat Januari 2021
    Route::get('/reportweekly/', 'ReportWeeklyController@index'); 
    Route::post('/reportweekly/detailsender', 'ReportWeeklyController@detailsender');
    Route::get('/reportweekly/{id}', 'ReportWeeklyController@show');
    Route::post('/reportweekly/datatable', 'ReportWeeklyController@datatable');  
    Route::post('/reportweekly/create', 'ReportWeeklyController@store'); 
    Route::put('/reportweekly/edit', 'ReportWeeklyController@update');
    Route::delete('/reportweekly/{id}', 'ReportWeeklyController@destroy');
    Route::get('/export/excel/reportweekly', 'ReportWeeklyController@exportFile'); 
	 
	//baru dibuat 2 juni 2019 
	Route::get('/dashboard/', 'DashboardController@index'); 
	Route::get('/reportmonthlysetting/', 'ReportMonthlyController@view'); 
    Route::post('/reportmonthly/datatable', 'ReportMonthlyController@datatable');

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');  
    Route::get('/changepassword', 'HomeController@changePassword');  
    
    Route::get('/user', 'UserController@index'); 
    Route::post('/user/datatable', 'UserController@datatable'); 
    Route::get('/user/datatableProject', 'UserController@datatableProject'); 
    Route::get('/user/{id}', 'UserController@show'); 
    Route::post('/user/create', 'UserController@store'); 
    Route::put('/user/edit', 'UserController@update');
    Route::delete('/user/{id}', 'UserController@destroy');
    Route::get('/export/excel/user', 'UserController@exportFile'); 
     
    Route::get('/groupuser', 'GroupUserController@index'); 
    Route::post('/groupuser/datatable', 'GroupUserController@datatable'); 
    Route::get('/groupuser/{id}', 'GroupUserController@show'); 
    Route::post('/groupuser/create', 'GroupUserController@store'); 
    Route::put('/groupuser/edit', 'GroupUserController@update');
    Route::delete('/groupuser/{id}', 'GroupUserController@destroy');
    Route::get('/export/excel/groupuser', 'GroupUserController@exportFile');  
     
    Route::get('/project', 'ProjectController@index'); 
    Route::post('/project/datatable', 'ProjectController@datatable'); 
    Route::get('/project/{id}', 'ProjectController@show'); 
    Route::post('/project/create', 'ProjectController@store'); 
    Route::put('/project/edit', 'ProjectController@update');
    Route::delete('/project/{id}', 'ProjectController@destroy');
    Route::get('/export/excel/project', 'ProjectController@exportFile');  
       
    Route::get('/userproject', 'UserProjectController@index'); 
    Route::post('/userproject/datatable', 'UserProjectController@datatable'); 
    Route::get('/userproject/{id}', 'UserProjectController@show'); 
    Route::post('/userproject/create', 'UserProjectController@store'); 
    Route::put('/userproject/edit', 'UserProjectController@update');
    Route::delete('/userproject/{id}', 'UserProjectController@destroy');
    Route::get('/export/excel/userproject', 'UserProjectController@exportFile'); 
     
    Route::get('/menu', 'MenuController@index'); 
    Route::post('/menu/datatable', 'MenuController@datatable'); 
    Route::get('/menu/{id}', 'MenuController@show'); 
    Route::post('/menu/create', 'MenuController@store'); 
    Route::put('/menu/edit', 'MenuController@update');
    Route::delete('/menu/{id}', 'MenuController@destroy');
    Route::get('/export/excel/menu', 'MenuController@exportFile'); 
     
    Route::get('/application', 'ApplicationController@index'); 
    Route::post('/application/datatable', 'ApplicationController@datatable'); 
    Route::get('/application/{id}', 'ApplicationController@show'); 
    Route::post('/application/create', 'ApplicationController@store'); 
    Route::put  ('/application/edit', 'ApplicationController@update');
    Route::delete('/application/{id}', 'ApplicationController@destroy');
    Route::get('/export/excel/application', 'ApplicationController@exportFile');
     
    Route::get('/userprivileges', 'UserPrivilegesController@index'); 
    Route::post('/userprivileges/datatable', 'UserPrivilegesController@datatable'); 
    Route::get('/userprivileges/{id}', 'UserPrivilegesController@show'); 
    Route::post('/userprivileges/create', 'UserPrivilegesController@store'); 
    Route::put  ('/userprivileges/edit', 'UserPrivilegesController@update');
    Route::delete('/userprivileges/{id}', 'UserPrivilegesController@destroy');
    Route::get('/export/excel/userprivileges', 'UserPrivilegesController@exportFile'); 
     
    Route::get('/bank', 'BankController@index'); 
    Route::post('/bank/datatable', 'BankController@datatable'); 
    Route::get('/bank/{id}', 'BankController@show'); 
    Route::post('/bank/create', 'BankController@store'); 
    Route::put('/bank/edit', 'BankController@update');
    Route::delete('/bank/{id}', 'BankController@destroy');
    Route::get('/export/excel/bank', 'BankController@exportFile');
     
    Route::get('/bankaccount', 'BankAccountController@index'); 
    Route::post('/bankaccount/datatable', 'BankAccountController@datatable'); 
    Route::get('/bankaccount/{id}', 'BankAccountController@show'); 
    Route::post('/bankaccount/create', 'BankAccountController@store'); 
    Route::put('/bankaccount/edit', 'BankAccountController@update');
    Route::delete('/bankaccount/{id}', 'BankAccountController@destroy');
    Route::get('/export/excel/bankaccount', 'BankAccountController@exportFile');
     
    Route::get('/cashbank', 'CashBankController@index'); 
    Route::post('/cashbank/datatable', 'CashBankController@datatable'); 
    Route::get('/cashbank/gettotalvalue/{project}/{year}/{month}/{week}', 'CashBankController@getTotal'); 
    Route::get('/cashbank/listbankaccount/{project_id}', 'CashBankController@getListBankAccount'); 
    Route::get('/cashbank/{id}', 'CashBankController@show'); 
    Route::post('/cashbank/create', 'CashBankController@store'); 
    Route::put('/cashbank/edit', 'CashBankController@update');
    Route::delete('/cashbank/{id}', 'CashBankController@destroy');
    Route::get('/sendmail/cashbank', 'CashBankController@sendEmail'); 
    Route::get('/autocompleteEmail/cashbank','CashBankController@autocompleteEmail');
     
    Route::get('/deposit', 'DepositController@index'); 
    Route::post('/deposit/datatable', 'DepositController@datatable'); 
    Route::get('/deposit/gettotalvalue/{project}/{year}/{month}/{week}', 'DepositController@getTotal'); 
    Route::post('/deposit/listbankaccount', 'DepositController@getListBankAccount');  
    Route::get('/deposit/{id}', 'DepositController@show'); 
    Route::post('/deposit/create', 'DepositController@store'); 
    Route::post('/deposit/createdoc', 'DepositController@storedoc'); 
    Route::put('/deposit/edit', 'DepositController@update');
    Route::delete('/deposit/{id}', 'DepositController@destroy');
    Route::get('/sendmail/deposit', 'DepositController@sendEmail');  
    Route::get('/autocompleteEmail/deposit','DepositController@autocompleteEmail');
	
	Route::get('/reportsummary', 'ReportSummaryController@index'); 
    Route::post('/reportsummary/datatable', 'ReportSummaryController@datatable'); 
    Route::get('/reportsummary/gettotalvalue/{project}/{year}/{month}/{week}', 'ReportSummaryController@getTotal'); 
    Route::post('/reportsummary/listbankaccount', 'ReportSummaryController@getListBankAccount');  
    Route::get('/reportsummary/{id}', 'ReportSummaryController@show'); 
    Route::post('/reportsummary/create', 'ReportSummaryController@store'); 
    Route::post('/reportsummary/createdoc', 'ReportSummaryController@storedoc'); 
    // Route::put('/reportsummary/edit', 'ReportSummaryController@update');
    // Route::delete('/reportsummary/{id}', 'ReportSummaryController@destroy');
    // Route::get('/sendmail/deposit', 'ReportSummaryController@sendEmail');  
    // Route::get('/autocompleteEmail/deposit','DepositController@autocompleteEmail');
     
    Route::get('/escrow', 'EscrowController@index'); 
    Route::post('/escrow/datatable', 'EscrowController@datatable'); 
    Route::get('/escrow/gettotalvalue/{project}/{year}/{month}/{week}', 'EscrowController@getTotal'); 
    Route::get('/escrow/listbankaccount/{project_id}', 'EscrowController@getListBankAccount'); 
    Route::get('/escrow/{id}', 'EscrowController@show'); 
    Route::post('/escrow/create', 'EscrowController@store'); 
    Route::put('/escrow/edit', 'EscrowController@update');
    Route::delete('/escrow/{id}', 'EscrowController@destroy');
    Route::get('/sendmail/escrow', 'EscrowController@sendEmail'); 
    Route::get('/autocompleteEmail/escrow','EscrowController@autocompleteEmail');
     
    Route::get('/bankoperational', 'BankOperationalController@index'); 
    Route::post('/bankoperational/datatable', 'BankOperationalController@datatable'); 
    Route::get('/bankoperational/gettotalvalue/{project}/{year}/{month}/{week}', 'BankOperationalController@getTotal'); 
    Route::get('/bankoperational/listbankaccount/{project_id}', 'BankOperationalController@getListBankAccount'); 
    Route::get('/bankoperational/{id}', 'BankOperationalController@show'); 
    Route::post('/bankoperational/create', 'BankOperationalController@store'); 
    Route::put('/bankoperational/edit', 'BankOperationalController@update');
    Route::delete('/bankoperational/{id}', 'BankOperationalController@destroy');
    Route::get('/sendmail/bankoperational', 'BankOperationalController@sendEmail'); 
    Route::get('/autocompleteEmail/bankoperational','BankOperationalController@autocompleteEmail');

    Route::get('/reksadana', 'ReksadanaController@index'); 
    Route::post('/reksadana/datatable', 'ReksadanaController@datatable'); 
    Route::get('/reksadana/gettotalvalue/{project}/{year}/{month}/{week}', 'ReksadanaController@getTotal'); 
    // Route::get('/reksadana/listbankaccount/{project_id}', 'ReksadanaController@getListBankAccount'); 
    Route::post('/reksadana/listbankaccount', 'ReksadanaController@getListBankAccount');  
    Route::get('/reksadana/{id}', 'ReksadanaController@show'); 
    Route::post('/reksadana/create', 'ReksadanaController@store'); 
    Route::put('/reksadana/edit', 'ReksadanaController@update');
    Route::delete('/reksadana/{id}', 'ReksadanaController@destroy');
    Route::get('/sendmail/reksadana', 'ReksadanaController@sendEmail'); 
    Route::get('/autocompleteEmail/reksadana','ReksadanaController@autocompleteEmail');
     
    Route::get('/bankloan', 'BankLoanController@index'); 
    Route::post('/bankloan/datatable', 'BankLoanController@datatable');  
    Route::get('/bankloan/gettotalvalue/{project}/{year}/{month}/{week}', 'BankLoanController@getTotal'); 
    Route::get('/bankloan/listbankaccount/{project_id}', 'BankLoanController@getListBankAccount'); 
    Route::get('/bankloan/{id}', 'BankLoanController@show'); 
    Route::post('/bankloan/create', 'BankLoanController@store'); 
    Route::put('/bankloan/edit', 'BankLoanController@update');
    Route::delete('/bankloan/{id}', 'BankLoanController@destroy');
    Route::get('/sendmail/bankloan', 'BankLoanController@sendEmail'); 
    Route::get('/autocompleteEmail/bankloan','BankLoanController@autocompleteEmail');
     
    Route::get('/bankdk', 'BankDKController@index'); 
    Route::get('/bankdk/datatable', 'BankDKController@datatable'); 
    Route::get('/bankdk/gettotalvalue/{project}/{year}/{month}/{week}', 'BankDKController@getTotal'); 
    Route::get('/bankdk/listbankaccount/{project_id}', 'BankDKController@getListBankAccount'); 
    Route::get('/bankdk/{id}', 'BankDKController@show'); 
    Route::post('/bankdk/create', 'BankDKController@store'); 
    Route::put('/bankdk/edit', 'BankDKController@update');
    Route::delete('/bankdk/{id}', 'BankDKController@destroy');
    Route::get('/sendmail/bankdk', 'BankDKController@sendEmail'); 
    Route::get('/autocompleteEmail/bankdk','BankDKController@autocompleteEmail');
     
    Route::get('/logreportcashbank', 'LogReportController@index'); 
    Route::post('/logreportcashbank/datatable', 'LogReportController@datatable'); 
    Route::get('/logreportcashbank/{id}', 'LogReportController@show');    
	
	
	
	
	
	
     
    Route::get('/dirview', 'DirViewController@index');   
      
     
     
     
     
	 
	 
    Route::get('/logout','AuthController@getLogout');
     
     
     
      
      
     
     
     
     
     
     
     
     
 });

//without auth for download report
Route::get('/export/excel/cashbank', 'CashBankController@exportFile');
Route::get('/export/excel/deposit', 'DepositController@exportFile'); 
Route::get('/export/excel/escrow', 'EscrowController@exportFile');
Route::get('/export/excel/bankoperational', 'BankOperationalController@exportFile'); 
Route::get('/export/excel/bankloan', 'BankLoanController@exportFile');
Route::get('/export/excel/bankdk', 'BankDKController@exportFile');




//Route::group(['middleware' => ['auth']], function () {
//    
//}); 
//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController'
//]); 
Route::auth();


