<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Mail\ApprovalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

Auth::routes();

//Route::get('/',function(){
//
//    Mail::to(['email'=>'marvincollins14@gmail.com'])
//        ->cc(\Esl\helpers\Constants::EMAILS_CC)
//        ->send(new \App\Mail\ProjectInvoice(['message'=>'System Under Maintenance',
//            'body'=>'System is Down for Maintenance'],'System Under maintenance'));
//    return view('404');
//
//
////    echo "check your mailtrap";
//
//});

Route::get('/testmail',function(){
    Mail::to(['email'=>'marvincollins14@gmail.com'])
        ->cc(['evans.ngala@esl-eastafrica.com'])
        ->send(new ApprovalRequest([
            'user' => 'Demo Demo',
            'url'=>'/quotation/view/1'],'Approval Request'));

    echo "check your mailtrap";

});
Route::get('/quotation/preview/{id}', 'QuotationController@previewQuotation');
Route::get('/quotation/download/{id}', 'QuotationController@downloadQuotation');
Route::get('/proforma/download/{id}', 'ProformaController@downloadProforma');
Route::get('/quotation/customer/accepted/{id}', 'QuotationController@customerAccept');
Route::get('/quotation/customer/declined/{id}', 'QuotationController@customerDecline');
Route::get('/view-po/{purchase_order_id}', 'PurchaseOrderController@showPurchaseOrder');


Route::group(['middleware' => ['auth']], function (){
    //    po
    Route::get('/generate-po/{quotation_id}', 'PurchaseOrderController@generatePo');
    Route::get('/approve-po/{purchase_order_id}', 'PurchaseOrderController@approvePurchaseOrder');
    Route::get('/disapprove-po/{purchase_order_id}', 'PurchaseOrderController@disapprovePurchaseOrder');

    Route::get('/', 'HomeController@dashboard');
    Route::resource('/customers', 'CustomerController');
    Route::resource('/manage-users', 'ManageController');
    Route::get('/create-role', 'ManageController@createRole');
    Route::delete('delete-role/{id}', 'ManageController@deleteRole');
    Route::get('/roles', 'ManageController@roleIndex');
    Route::post('/store-role', 'ManageController@storeRole');
    Route::get('/customer-request/{customer_id}/{customer_type}', 'CustomerRequestController@customerRequest');
    Route::resource('/good-types', 'GoodTypeController');
    Route::resource('/container-types', 'ContainerTypeController');
    Route::resource('/leads', 'LeadController');
    Route::resource('/tariffs', 'TariffController');
    Route::resource('/departments', 'DepartmentController');
    Route::post('/search-lead', 'LeadController@searchLeads');
    Route::post('/error', 'DepartmentController@error');
    Route::post('/search-dms', 'DmsController@searchDms');
    Route::post('/update-berth', 'DmsController@updateBerth');
    Route::post('/search-customer', 'CustomerController@ajaxSearch');
    Route::get('/get-customer/{dclink}', 'CustomerController@getCustomer');
    Route::get('/get-vendor/{id}', 'PurchaseOrderController@getVendor');
    Route::post('/search-vendor', 'PurchaseOrderController@searchSupplier');
    Route::post('/add-purchase-order', 'PurchaseOrderController@addPurchaseOrder');
    Route::post('/update-vessel-details', 'CustomerController@updateVessel');
    Route::post('/vessel-details', 'CustomerController@vesselDetails');
    Route::post('/others-vessel-details', 'CustomerController@oVesselDetails');
    Route::post('/voyage-details', 'CustomerController@voyageDetails');
    Route::post('/consignee-details', 'CustomerController@consigneeDetails');
    Route::post('/cargo-details', 'CustomerController@cargoDetails');
    Route::post('/update-cargo-details', 'CustomerController@updateCargoDetails');
    Route::post('/delete-cargo', 'CustomerController@deleteCargo');
    Route::post('/quotation-service', 'QuotationServiceController@addQuotationService');
    Route::post('/quotation-service-delete', 'QuotationServiceController@deleteQuotationService');
    Route::get('/quotation/{id}', 'QuotationController@showQuotation');
    Route::post('/update-rem', 'QuotationController@updateRemmitance');
    Route::get('/proforma/{id}', 'ProformaController@showQuotation');
    Route::get('/my-pdas', 'QuotationController@myPdas');
    Route::get('/all-pdas', 'QuotationController@allPdas');
    Route::get('/pdas/{status}', 'QuotationController@pdaStatus');
    Route::get('/quotation/view/{id}', 'QuotationController@viewQuotation');
    Route::post('/client/quotation/send/', 'QuotationController@sendToCustomer');
    Route::get('/all-notifications', 'NotificationController@index');
    Route::get('/agency', 'AgencyController@index');
    Route::post('/agency/approve', 'AgencyApprovalController@approve');
    Route::post('/agency/remark', 'AgencyApprovalController@addRemark');
    Route::post('/agency/disapprove', 'AgencyApprovalController@revision');
    Route::post('/agency/checked', 'AgencyApprovalController@checked');
    Route::get('/notifications/{id}', 'NotificationController@show');
    Route::get('/quotation/request/{id}', 'QuotationController@requestQuotation');
//Route::get('/quotation/{id}/pdf', 'QuotationController@pdfQuotation');
    Route::post('/update-service', 'QuotationServiceController@updateService');
    Route::post('/notifying', 'NotifyingPartyController@notifying');

//next stage
    Route::get('/tatation/convert/{id}', 'QuotationController@convertCustomer');
    Route::get('/quotation/convert/{id}', 'QuotationController@convertCustomer');
    Route::get('/bill-of-lading/{id}', 'BillOfLandingController@edit');
    Route::get('/test/', 'BillOfLandingController@test');
//dms
    Route::get('/dms', 'DmsController@index');
    Route::get('/dms/edit/{id}', 'DmsController@edit');
    Route::get('/dms/complete/{id}', 'DmsController@complete');
    Route::get('/generate/laytime/{id}', 'DmsController@generateLayTime');
    Route::get('/generate/sof/{id}', 'DmsController@generateSof');
    Route::post('/dms/store/', 'DmsController@store');
    Route::post('/dms/add/sof', 'DmsController@addSof');
    Route::get('/dms/delete/sof/{id}', 'DmsController@deleteSof');
    Route::post('/update-dms/', 'DmsController@updateDms');
    Route::get('/view-q/{id}', 'DmsController@viewQoute');
    Route::post('/vessel/doc/upload/', 'VesselDocsController@upload');
    Route::post('/add-remittance', 'QuotationController@addRemittance');
    Route::post('/reduce-remittance', 'QuotationController@reduceRemittance');
    Route::post('/consignee/do', 'GenerateDocument@doDoc');
    Route::post('/consignee/edo', 'GenerateDocument@edoDoc');
    Route::post('/generate-documents/cfs-ro', 'GenerateDocument@cfsDoc');
    Route::post('/generate-documents/manifest-in', 'GenerateDocument@inmanifestDoc');
//stage
    Route::resource('/stages', 'StageController');
    Route::resource('/other-services-type', 'ExtraServiceTypeController');
    Route::resource('/other-services', 'ExtraServiceController');
    Route::resource('/stage-components', 'StageComponentController');
//generate docs
    Route::get('/generate-documents/{type}/{id}', 'GenerateDocument@generateDocument');
    Route::resource('/project-cost', 'PettyCashController');
    Route::get('/approve-project-cost-request/{petty_cash_id}', 'PettyCashController@approve');
    Route::post('/service-cost', 'QuotationController@serviceCost');

    //Reports
    Route::resource('reports','ReportsController');
    Route::get('export-pdf/{from}/{to}/{status}/{type}','ReportsController@exportPDF');
    Route::get('leads-report','ReportsController@leadsReport');
    Route::get('export-lead/{from}/{to}/{type}','ReportsController@exportLead');
    Route::post('get-leads','ReportsController@getLeads');
    Route::get('pdas-report','ReportsController@pdasReport');
    Route::get('export-pda/{from}/{to}/{type}','ReportsController@exportPda');
    Route::post('get-pdas','ReportsController@getPdas');
    Route::get('pos-report','ReportsController@posReport');
    Route::get('export-po/{from}/{to}/{status}/{type}','ReportsController@exportPo');
    Route::post('get-pos','ReportsController@getPos');
});

