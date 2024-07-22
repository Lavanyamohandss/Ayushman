<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MstBranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MstStaffController;
use App\Http\Controllers\MstExternalDoctorController;
use App\Http\Controllers\MstTherapyController;
use App\Http\Controllers\MstTimeSlotController;
use App\Http\Controllers\MstPatientController;
use App\Http\Controllers\MstTherapyRoomController;
use App\Http\Controllers\MstMembershipController;
use App\Http\Controllers\MstWellnessController;

use App\Http\Controllers\MstUnitController;
use App\Http\Controllers\MstTaxController;
use App\Http\Controllers\MstMedicineController;
use App\Http\Controllers\TrnConsultationBillingController;
use App\Http\Controllers\BookingTypeController;
use App\Http\Controllers\PatientSearchController;
use App\Http\Controllers\MstSupplierController;
use App\Http\Controllers\Auth\MstAuthController;
use App\Http\Controllers\MstStaffSpecializationController;
use App\Http\Controllers\MstTherapyRoomAssigningController;
use App\Http\Controllers\MstMasterValueController;
use App\Http\Controllers\UserPrivilageController;
use App\Http\Controllers\MstQualificationController;
use App\Http\Controllers\MstMedicineDosageController;
use App\Http\Controllers\MstLeaveTypeController;
use App\Http\Controllers\MstManufacturerController;
use App\Http\Controllers\MstTaxGroupController;
use App\Http\Controllers\AccountSubGroupController;
use App\Http\Controllers\AccountLedgerController;
use App\Http\Controllers\EmployeeBranchTransferController;
use App\Http\Controllers\MedicinePurchaseController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\MstUserController;


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

Route::get('/', function () {
    return view('welcome'); 
});

Auth::routes();

Route::get('/home', [DashboardController::class, 'index'])->name('home');
//Manage-Branches:
// test 
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('password.email.send');
Route::get('reset-password/{token}/{email}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('password.update');
// test ends 

Route::middleware('auth')->group(function () {
 Route::get('/branches', [MstBranchController::class, 'index'])->name('branches');
Route::get('/branches/create', [MstBranchController::class, 'create'])->name('branches.create');
Route::post('/branches/store', [MstBranchController::class, 'store'])->name('branches.store');
Route::get('/branches/edit/{branch_id}', [MstBranchController::class, 'edit'])->name('branches.edit');
Route::get('/branches/show/{branch_id}', [MstBranchController::class, 'show'])->name('branches.show');
Route::delete('/branches/destroy/{branch_id}', [MstBranchController::class,'destroy'])->name('branches.destroy');
Route::patch('branches/change-status/{branch_id}', [MstBranchController::class, 'changeStatus'])->name('branches.changeStatus');
Route::put('/branches/update/{branch_id}', [MstBranchController::class,'update'])->name('branches.update');
Route::post('/branches/restore', [MstBranchController::class,'restoreBranches'])->name('branches.restore');
});

// Manage user privilage 
Route::get('/user-type/index', [UserPrivilageController::class, 'indexUserType'])->name('usertype.index');
Route::get('/user-type/create', [UserPrivilageController::class, 'createUserType'])->name('usertype.create');
Route::post('/user-type/store', [UserPrivilageController::class, 'storeUserType'])->name('usertype.store');
Route::get('/user-type/edit/{id}', [UserPrivilageController::class, 'editUserType'])->name('usertype.edit');
Route::delete('/user-type/destroy/{id}', [UserPrivilageController::class, 'destroyUserType'])->name('usertype.destroy');

// usertype Access 
Route::get('/user-type-access/create', [UserPrivilageController::class, 'createUserTypeAccess'])->name('usertype.access.create');
// user wise access 
Route::get('/user-access/create', [UserPrivilageController::class, 'createUserTypeAccess'])->name('usertype.access.create');

//Manage-Staffs:
Route::get('/staffs/index', [MstStaffController::class, 'index'])->name('staffs.index');
Route::get('/staffs/create', [MstStaffController::class, 'create'])->name('staffs.create');
Route::post('/staffs/store', [MstStaffController::class, 'store'])->name('staffs.store');
Route::get('/staffs/edit/{staff_id}', [MstStaffController::class, 'edit'])->name('staffs.edit');
Route::get('/staffs/show/{staff_id}', [MstStaffController::class, 'show'])->name('staffs.show');
Route::delete('/staffs/destroy/{staff_id}', [MstStaffController::class,'destroy'])->name('staffs.destroy');
Route::put('/staffs/update/{staff_id}', [MstStaffController::class,'update'])->name('staffs.update');
Route::post('/staffs/restore', [MstStaffController::class,'restore'])->name('staffs.restore');
Route::patch('staffs/{staff_id}/change-status', [MstStaffController::class, 'changeStatus'])->name('staffs.changeStatus');
//Manage-External-Doctors:
Route::get('/externaldoctors/index', [MstExternalDoctorController::class, 'index'])->name('externaldoctors.index');
Route::get('/externaldoctors/create', [MstExternalDoctorController::class, 'create'])->name('externaldoctors.create');
Route::post('/externaldoctors/store', [MstExternalDoctorController::class, 'store'])->name('externaldoctors.store');
Route::get('/externaldoctors/edit/{id}', [MstExternalDoctorController::class, 'edit'])->name('externaldoctors.edit');
Route::get('/externaldoctors/show/{id}', [MstExternalDoctorController::class, 'show'])->name('externaldoctors.show');
Route::delete('/externaldoctors/destroy/{id}', [MstExternalDoctorController::class,'destroy'])->name('externaldoctors.destroy');
Route::put('/externaldoctors/update/{id}', [MstExternalDoctorController::class,'update'])->name('externaldoctors.update');
Route::patch('externaldoctors/change-status/{id}', [MstExternalDoctorController::class, 'changeStatus'])->name('externaldoctors.changeStatus');
//Manage-Therapies:
Route::get('/therapies/index', [MstTherapyController::class, 'index'])->name('therapy.index');
Route::get('/therapies/create', [MstTherapyController::class, 'create'])->name('therapy.create');
Route::post('/therapies/store', [MstTherapyController::class, 'store'])->name('therapy.store');
Route::get('/therapies/edit/{id}', [MstTherapyController::class, 'edit'])->name('therapy.edit');
Route::delete('/therapies/destroy/{id}', [MstTherapyController::class,'destroy'])->name('therapy.destroy');
Route::put('/therapies/update/{id}', [MstTherapyController::class,'update'])->name('therapy.update');
Route::patch('therapies/change-status/{id}', [MstTherapyController::class, 'changeStatus'])->name('therapy.changeStatus');

//Manage-TimeSlots:
Route::resource('timeslot', MstTimeSlotController::class);
Route::patch('timeslot/{id}/change-status', [MstTimeSlotController::class, 'changeStatus'])->name('timeslot.changeStatus');
Route::get('/timeslot/show/{id}', [MstTimeSlotController::class, 'show'])->name('timeslot.show');
Route::delete('/timeslot-staff/destroy/{id}', [MstTimeSlotController::class, 'slotDelete'])->name('timeslotStaff.destroy');
//Manage-Patients:
Route::get('/patients/index', [MstPatientController::class, 'index'])->name('patients.index');
Route::get('/patients/create', [MstPatientController::class, 'create'])->name('patients.create');
Route::post('/patients/store', [MstPatientController::class, 'store'])->name('patients.store');
Route::get('/patients/edit/{id}', [MstPatientController::class, 'edit'])->name('patients.edit');
Route::get('/patients/show/{id}', [MstPatientController::class, 'show'])->name('patients.show');
Route::delete('/patients/destroy/{id}', [MstPatientController::class,'destroy'])->name('patients.destroy');
Route::put('/patients/update/{id}', [MstPatientController::class,'update'])->name('patients.update');
Route::patch('patients/change-status/{id}', [MstPatientController::class, 'changeStatus'])->name('patients.changeStatus');
Route::patch('/patients/toggle-otp-verification/{id}', [MstPatientController::class,'toggleOTPVerification'])->name('patients.toggleOTPVerification');
Route::patch('/patients/toggle-approval/{id}', [MstPatientController::class,'toggleApproval'])->name('patients.toggleApproval');
Route::get('/patients/membership-assigning/{id}', [MstPatientController::class,'patientMembershipAssigning'])->name('patients.membership.assigning');




//Manage-Therapy-Rooms:
Route::get('/therapyrooms/index', [MstTherapyRoomController::class, 'index'])->name('therapyrooms.index');
Route::get('/therapyrooms/create', [MstTherapyRoomController::class, 'create'])->name('therapyrooms.create');
Route::post('/therapyrooms/store', [MstTherapyRoomController::class, 'store'])->name('therapyrooms.store');
Route::get('/therapyrooms/edit/{id}', [MstTherapyRoomController::class, 'edit'])->name('therapyrooms.edit');
Route::delete('/therapyrooms/destroy/{id}', [MstTherapyRoomController::class,'destroy'])->name('therapyrooms.destroy');
Route::put('/therapyrooms/update/{id}', [MstTherapyRoomController::class,'update'])->name('therapyrooms.update');
Route::patch('therapyrooms/change-status/{id}', [MstTherapyRoomController::class, 'changeStatus'])->name('therapyrooms.changeStatus');

//Manage-Memberships:
Route::get('/membership/index', [MstMembershipController::class, 'index'])->name('membership.index');
Route::get('/membership/create', [MstMembershipController::class, 'create'])->name('membership.create');
Route::post('/membership/store', [MstMembershipController::class, 'store'])->name('membership.store');
Route::get('/membership/edit/{id}/{active_tab}', [MstMembershipController::class, 'edit'])->name('membership.edit');
Route::post('/membership/update/{id}', [MstMembershipController::class, 'update'])->name('membership.update');
Route::delete('/membership/destroy/{id}', [MstMembershipController::class, 'destroyMembershipPackage'])->name('membership.destroy');
Route::patch('membership/{id}/change-status', [MstMembershipController::class, 'changeStatus'])->name('membership.changeStatus');
Route::delete('/membership/destroy-wellness/{id}', [MstMembershipController::class, 'deleteWellness'])->name('membership.destroy.wellness');
Route::delete('/membership/destroy-benefit/{id}', [MstMembershipController::class, 'deleteBenefit'])->name('membership.destroy.benefit');
Route::get('/membership/view/{id}', [MstMembershipController::class, 'viewMembership'])->name('membership.view');

//Manage-Wellness:
Route::get('/wellness/index', [MstWellnessController::class, 'index'])->name('wellness.index');
Route::get('/wellness/create', [MstWellnessController::class, 'create'])->name('wellness.create');
Route::post('/wellness/store', [MstWellnessController::class, 'store'])->name('wellness.store');
Route::get('/wellness/edit/{wellness_id}', [MstWellnessController::class, 'edit'])->name('wellness.edit');
Route::put('/wellness/update/{wellness_id}', [MstWellnessController::class, 'update'])->name('wellness.update');
Route::get('/wellness/show/{wellness_id}', [MstWellnessController::class, 'show'])->name('wellness.show');
Route::delete('/wellness/destroy/{wellness_id}', [MstWellnessController::class, 'destroy'])->name('wellness.destroy');
Route::patch('wellness/change-status/{wellness_id}', [MstWellnessController::class, 'changeStatus'])->name('wellness.changeStatus');



//Manage-Units:
Route::get('/unit/index', [MstUnitController::class, 'index'])->name('unit.index');
Route::get('/unit/create', [MstUnitController::class, 'create'])->name('unit.create');
Route::post('/unit/store', [MstUnitController::class, 'store'])->name('unit.store');
Route::get('/unit/edit/{id}', [MstUnitController::class, 'edit'])->name('unit.edit');
Route::put('/unit/update/{id}', [MstUnitController::class, 'update'])->name('unit.update');
Route::delete('/unit/destroy/{id}', [MstUnitController::class, 'destroy'])->name('unit.destroy');
Route::patch('unit/change-status/{id}', [MstUnitController::class, 'changeStatus'])->name('unit.changeStatus');

//Manage-Taxes:
Route::get('/tax/index', [MstTaxController::class, 'index'])->name('tax.index');
Route::get('/tax/create', [MstTaxController::class, 'create'])->name('tax.create');
Route::post('/tax/store', [MstTaxController::class, 'store'])->name('tax.store');
Route::get('/tax/edit/{id}', [MstTaxController::class, 'edit'])->name('tax.edit');
Route::put('/tax/update/{id}', [MstTaxController::class, 'update'])->name('tax.update');
Route::delete('/tax/destroy/{id}', [MstTaxController::class, 'destroy'])->name('tax.destroy');
Route::patch('tax/change-status/{id}', [MstTaxController::class, 'changeStatus'])->name('tax.changeStatus');

//Manage-Medicines:
Route::get('/medicine/index', [MstMedicineController::class, 'index'])->name('medicine.index');
Route::get('/medicine/create', [MstMedicineController::class, 'create'])->name('medicine.create');
Route::post('/medicine/store', [MstMedicineController::class, 'store'])->name('medicine.store');
Route::get('/medicine/edit/{id}', [MstMedicineController::class, 'edit'])->name('medicine.edit');
Route::put('/medicine/update/{id}', [MstMedicineController::class, 'update'])->name('medicine.update');
Route::get('/medicine/show/{id}', [MstMedicineController::class, 'show'])->name('medicine.show');
Route::delete('/medicine/destroy/{id}', [MstMedicineController::class, 'destroy'])->name('medicine.destroy');
Route::patch('medicine/change-status/{id}', [MstMedicineController::class, 'changeStatus'])->name('medicine.changeStatus');

//Consultation-Billing:
Route::get('/consultation-billing/index', [TrnConsultationBillingController::class, 'index'])->name('consultation_billing.index');
Route::get('/consultation-billing/create', [TrnConsultationBillingController::class, 'create'])->name('consultation_billing.create');
Route::post('/consultation-billing/store', [TrnConsultationBillingController::class, 'store'])->name('consultation_billing.store');
Route::get('/consultation-billing/edit/{id}', [TrnConsultationBillingController::class, 'edit'])->name('consultation_billing.edit');
Route::put('/consultation-billing/update/{id}', [TrnConsultationBillingController::class, 'update'])->name('consultation_billing.update');
Route::delete('/consultation-billing/destroy/{id}', [TrnConsultationBillingController::class, 'destroy'])->name('consultation_billing.destroy');
Route::patch('consultation-billing/{id}/change-status', [TrnConsultationBillingController::class, 'changeStatus'])->name('consultation_billing.changeStatus');

//Booking-Type:(consultation)
Route::get('/booking-type/index', [BookingTypeController::class, 'index'])->name('booking_type.index');
Route::get('/booking-type/show/{id}', [BookingTypeController::class, 'show'])->name('booking_type.show');
//Booking-Type:(wellness)
Route::get('/booking-type/wellnessIndex', [BookingTypeController::class, 'wellnessIndex'])->name('booking_type.wellnessIndex');
Route::get('/booking-type/wellnessShow/{id}', [BookingTypeController::class, 'wellnessShow'])->name('booking_type.wellnessShow');
//Booking-Type:(therapy)
Route::get('/booking-type/therapyIndex', [BookingTypeController::class, 'therapyIndex'])->name('booking_type.therapyIndex');
Route::get('/booking-type/therapyShow/{id}', [BookingTypeController::class, 'therapyShow'])->name('booking_type.therapyShow');


//patient-search:
Route::get('/patient-search/index', [PatientSearchController::class, 'index'])->name('patient_search.index');
Route::get('/patient-search/show/{id}', [PatientSearchController::class, 'show'])->name('patient_search.show');

//Manage-suppliers:
Route::get('/supplier/index',[MstSupplierController::class, 'index'])->name('supplier.index');
Route::get('/supplier/create',[MstSupplierController::class,'create'])->name('supplier.create');
Route::post('/supplier/store', [MstSupplierController::class, 'store'])->name('supplier.store');
Route::get('/supplier/edit/{id}', [MstSupplierController::class, 'edit'])->name('supplier.edit');
Route::put('/supplier/update/{id}', [MstSupplierController::class, 'update'])->name('supplier.update');
Route::delete('/supplier/destroy/{id}', [MstSupplierController::class, 'destroy'])->name('supplier.destroy');
Route::patch('supplier/{id}/change-status', [MstSupplierController::class, 'changeStatus'])->name('supplier.changeStatus');

//Authentication:
Route::get('/login', [MstAuthController::class, 'showLoginForm'])->name('mst_login');
Route::post('/admin-login', [MstAuthController::class, 'login'])->name('mst_login_redirect');
Route::match(['get', 'post'],'/logout', [MstAuthController::class, 'logout'])->name('logout');
Route::get('/verification-request', [MstAuthController::class, 'verificationRequest'])->name('verification.request');
// Route::post('/verify-email', [MstAuthController::class, 'verifyEmail'])->name('verify.email');
Route::post('/reset-password', [MstAuthController::class, 'resetPassword'])->name('reset.password');

//Manage-Specialization:
Route::get('/specialization/index/{id}', [MstStaffSpecializationController::class, 'index'])->name('specialization.index');
Route::get('/specialization/create', [MstStaffSpecializationController::class, 'create'])->name('specialization.create');
Route::post('/specialization/store', [MstStaffSpecializationController::class, 'store'])->name('specialization.store');
Route::get('/specialization/edit/{id}', [MstStaffSpecializationController::class, 'edit'])->name('specialization.edit');
Route::put('/specialization/update/{id}', [MstStaffSpecializationController::class, 'update'])->name('specialization.update');
Route::delete('/specialization/destroy/{id}', [MstStaffSpecializationController::class, 'destroy'])->name('specialization.destroy');
Route::patch('specialization/{id}/change-status', [MstStaffSpecializationController::class, 'changeStatus'])->name('specialization.changeStatus');

//therapy-room-assigning:
Route::get('/therapyroom-assigning/index/{id}', [MstTherapyRoomAssigningController::class, 'index'])->name('therapyroomassigning.index');
Route::get('/therapyroom-assigning/create', [MstTherapyRoomAssigningController::class, 'create'])->name('therapyroomassigning.create');
Route::post('/therapyroom-assigning/store', [MstTherapyRoomAssigningController::class, 'store'])->name('therapyroomassigning.store');
Route::get('/therapyroom-assigning/edit/{id}', [MstTherapyRoomAssigningController::class, 'edit'])->name('therapyroomassigning.edit');
Route::put('/therapyroom-assigning/update/{id}', [MstTherapyRoomAssigningController::class, 'update'])->name('therapyroomassigning.update');
Route::delete('/therapyroom-assigning/destroy/{id}', [MstTherapyRoomAssigningController::class, 'destroy'])->name('therapyroomassigning.destroy');
Route::patch('therapyroom-assigning/change-status/{id}', [MstTherapyRoomAssigningController::class, 'changeStatus'])->name('therapyroomassigning.changeStatus');
Route::get('/get-therapy-rooms/{branchId}', [MstTherapyRoomAssigningController::class, 'getTherapyRooms']);



//Manage-Mastervalues:
Route::get('/masters', [MstMasterValueController::class, 'index'])->name('mastervalues.index');
Route::get('/masters/create', [MstMasterValueController::class, 'create'])->name('mastervalues.create');
Route::post('/masters/store', [MstMasterValueController::class, 'store'])->name('mastervalues.store');
Route::get('/masters/edit/{id}', [MstMasterValueController::class, 'edit'])->name('mastervalues.edit');
Route::get('/masters/show/{id}', [MstMasterValueController::class, 'show'])->name('mastervalues.show');
Route::put('/masters/update/{id}', [MstMasterValueController::class, 'update'])->name('mastervalues.update');
Route::delete('/masters/destroy/{id}', [MstMasterValueController::class, 'destroy'])->name('mastervalues.destroy');
Route::patch('masters/{id}/change-status', [MstMasterValueController::class, 'changeStatus'])->name('mastervalues.changeStatus');


//timeslot-storing in mst_master_values table:
Route::post('/mastervalues/store', [MstTimeSlotController::class,'store'])->name('mastervalue.store');
//adding timeslot for a particular staff:
Route::get('/timeslot-staff/slot/{id}',[MstTimeSlotController::class,'slotIndex'])->name('staff.slot');
Route::post('/timeslot-staff/store',[MstTimeSlotController::class, 'slotStore'])->name('timeslotStaff.store');

// Qualification - Screen for qualification
Route::get('/qualifications', [MstQualificationController::class, 'index'])->name('qualifications.index');
Route::get('/qualifications/create', [MstQualificationController::class, 'create'])->name('qualifications.create');
Route::post('/qualifications/store', [MstQualificationController::class, 'store'])->name('qualifications.store');
Route::delete('/qualifications/destroy/{id}', [MstQualificationController::class, 'destroy'])->name('qualifications.destroy');
Route::get('/qualifications/edit/{id}', [MstQualificationController::class, 'edit'])->name('qualifications.edit');
Route::patch('qualifications/change-status/{id}', [MstQualificationController::class, 'changeStatus'])->name('qualifications.changeStatus');

// Medicine dosage - Screen for medicine dosges
Route::get('/medicine-dosage', [MstMedicineDosageController::class, 'index'])->name('medicine.dosage.index');
Route::get('/medicine-dosage/create', [MstMedicineDosageController::class, 'create'])->name('medicine.dosage.create');
Route::post('/medicine-dosage/store', [MstMedicineDosageController::class, 'store'])->name('medicine.dosage.store');
Route::delete('/medicine-dosage/destroy/{id}', [MstMedicineDosageController::class, 'destroy'])->name('medicine.dosage.destroy');
Route::get('/medicine-dosage/edit/{id}', [MstMedicineDosageController::class, 'edit'])->name('medicine.dosage.edit');
Route::patch('medicine-dosage/change-status/{id}', [MstMedicineDosageController::class, 'changeStatus'])->name('medicine.dosage.changeStatus');


// Leave type - Screen for leave types
Route::get('/leave-type', [MstLeaveTypeController::class, 'index'])->name('leave.type.index');
Route::get('/leave-type/create', [MstLeaveTypeController::class, 'create'])->name('leave.type.create');
Route::post('/leave-type/store', [MstLeaveTypeController::class, 'store'])->name('leave.type.store');
Route::delete('/leave-type/destroy/{id}', [MstLeaveTypeController::class, 'destroy'])->name('leave.type.destroy');
Route::get('/leave-type/edit/{id}', [MstLeaveTypeController::class, 'edit'])->name('leave.type.edit');
Route::patch('leave-type/change-status/{id}', [MstLeaveTypeController::class, 'changeStatus'])->name('leave.type.changeStatus');
Route::patch('leave-type/change-deductible/{id}', [MstLeaveTypeController::class, 'changeDeductible'])->name('leave.type.changeDeductible');


// Manufacturer- Screen for manufacturer
Route::get('/manufacturer', [MstManufacturerController::class, 'index'])->name('manufacturer.index');
Route::get('/manufacturer/create', [MstManufacturerController::class, 'create'])->name('manufacturer.create');
Route::post('/manufacturer/store', [MstManufacturerController::class, 'store'])->name('manufacturer.store');
Route::delete('/manufacturer/destroy/{id}', [MstManufacturerController::class, 'destroy'])->name('manufacturer.destroy');
Route::get('/manufacturer/edit/{id}', [MstManufacturerController::class, 'edit'])->name('manufacturer.edit');
Route::patch('manufacturer/change-status/{id}', [MstManufacturerController::class, 'changeStatus'])->name('manufacturer.changeStatus');

//Manage-Tax-Groups:
Route::get('/tax-group/index', [MstTaxGroupController::class, 'index'])->name('tax.group.index');
Route::get('/tax-group/create', [MstTaxGroupController::class, 'create'])->name('tax.group.create');
Route::post('/tax-group/store', [MstTaxGroupController::class, 'store'])->name('tax.group.store');
Route::get('/tax-group/edit/{id}', [MstTaxGroupController::class, 'edit'])->name('tax.group.edit');
Route::put('/tax-group/update/{id}', [MstTaxGroupController::class, 'update'])->name('tax.group.update');
Route::delete('/tax-group/destroy/{id}', [MstTaxGroupController::class, 'destroy'])->name('tax.group.destroy');
Route::patch('tax-group/change-status/{id}', [MstTaxGroupController::class, 'changeStatus'])->name('tax-group.changeStatus');

//Manage-Account-Subhead
Route::get('/account-sub-group/index', [AccountSubGroupController::class, 'index'])->name('account.sub.group.index');
Route::get('/account-sub-group/create', [AccountSubGroupController::class, 'create'])->name('account.sub.group.create');
Route::post('/account-sub-group/store', [AccountSubGroupController::class, 'store'])->name('account.sub.group.store');
Route::get('/account-sub-group/edit/{id}', [AccountSubGroupController::class, 'edit'])->name('account.sub.group.edit');
Route::delete('/account-sub-group/destroy/{id}', [AccountSubGroupController::class,'destroy'])->name('account.sub.group.destroy');
Route::put('/account-sub-group/update/{id}', [AccountSubGroupController::class,'update'])->name('account.sub.group.update');
Route::patch('account-sub-group/change-status/{id}', [AccountSubGroupController::class, 'changeStatus'])->name('account.sub.group.changeStatus');

//Manage-Account-Ledger
Route::get('/account-ledger/index', [AccountLedgerController::class, 'index'])->name('account.ledger.index');
Route::get('/account-ledger/create', [AccountLedgerController::class, 'create'])->name('account.ledger.create');
Route::post('/account-ledger/store', [AccountLedgerController::class, 'store'])->name('account.ledger.store');
Route::get('/account-ledger/edit/{id}', [AccountLedgerController::class, 'edit'])->name('account.ledger.edit');
Route::delete('/account-ledger/destroy/{id}', [AccountLedgerController::class,'destroy'])->name('account.ledger.destroy');
Route::put('/account-ledger/update/{id}', [AccountLedgerController::class,'update'])->name('account.ledger.update');
Route::patch('account-ledger/changeStatus/{id}', [AccountLedgerController::class, 'changeStatus'])->name('account.ledger.changeStatus');
Route::patch('/get-account-sub-groups/{id}', [AccountLedgerController::class,'getAccountSubGroups'])->name('get.account.sub.groups');


// staff-branch-transer:
Route::get('/staff-branch-transfer', [EmployeeBranchTransferController::class, 'index'])->name('branchTransfer.index');
Route::post('/staff-branch-transfer/store', [EmployeeBranchTransferController::class, 'store'])->name('branchTransfer.store');
Route::get('/get-employees/{branchId}', [EmployeeBranchTransferController::class, 'getEmployees'])->name('get.employees');


// Medicine Purchase
Route::get('/medicine-purchase/index ', [MedicinePurchaseController::class, 'index'])->name('medicine.purchase.index');
Route::get('/medicine-purchase/create', [MedicinePurchaseController::class, 'create'])->name('medicine.purchase.create');

// patient-membership 
Route::get('/patients/membership/{id}', [MstPatientController::class, 'addMembershipIndex'])->name('patients.membership');
Route::post('/patients/membership/store/{id}', [MstPatientController::class, 'patientMembershipStore'])->name('patientsMembership.store');
Route::get('/get-wellness-details/{membershipId}', [MstPatientController::class ,'getWellnessDetails'])->name('getwellness.details');


//Manage-Users:
Route::get('/user/index',[MstUserController::class,'index'])->name('user.index');
Route::get('/user/create',[MstUserController::class,'create'])->name('user.create');
Route::post('/user/store', [MstUserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [MstUserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [MstUserController::class, 'update'])->name('user.update');
Route::get('/user/show/{id}', [MstUserController::class, 'show'])->name('user.show');
Route::delete('/user/destroy/{id}', [MstUserController::class, 'destroy'])->name('user.destroy');
Route::patch('user/change-status/{id}', [MstUserController::class, 'changeStatus'])->name('user.changeStatus');