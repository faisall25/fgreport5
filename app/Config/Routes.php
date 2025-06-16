<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->setAutoRoute(true);
// $routes->get('/', 'Home::index');

// $routes->get('/', 'Pages::index');

$routes->get('/', 'Home::redirectByRole');
$routes->get('auth/', 'Home::redirectByRole');
$routes->get('' . session()->get('role') . '/', 'Home::redirectByRole');

// Route login & logout
$routes->get('auth/login', 'Auth::index');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('errors/unauthorized', 'Auth::unauthorized');

// Pages Group
$routes->group('pages', ['filter' => 'role: monitor, fgstock, kasie, admin'], function ($routes) {
    $routes->post('updatepc', 'Pages::updatePc');
    $routes->post('valident', 'Pages::valIdent');

    $routes->post('updatehasil', 'Pages::updateHasil');
    $routes->post('delhasil', 'Pages::delHasil');

    $routes->post('updatealldata', 'Pages::updateAlldata');
    $routes->post('delalldata', 'Pages::delAlldata');

    $routes->post('resetshift', 'Pages::resetShift');
    $routes->post('getSkuByLine', 'Pages::getSkuByLine');
    $routes->post('savetarget', 'Pages::saveTarget');
    $routes->post('updatetarget', 'Pages::updateTarget');
    $routes->post('deltarget', 'Pages::delTarget');

    $routes->post('getLineByIdSku', 'Pages::getLineByIdSku');
    $routes->post('savefg', 'Pages::saveFg');

    $routes->post('getDateTime', 'Pages::getDateTime');
    $routes->post('monitorTabel', 'Pages::monitorTabel');

    $routes->post('getDataEtiket', 'Pages::getDataEtiket');
    $routes->post('updatemesin', 'pages::updateMesin');

    $routes->post('getTotalKarton', 'Pages::getTotalKarton');
    $routes->post('getTotalPallet', 'Pages::getTotalPallet');
    $routes->post('getTotalSku', 'Pages::getTotalSku');
    $routes->post('getTotalTarget', 'Pages::getTotalTarget');
    $routes->post('getProdTime', 'Pages::getProdTime');
    // $routes->get('chart', 'Pages::getChartPallet');

    $routes->post('getSkuByLineManual', 'Pages::getSkuByLineManual');
    $routes->post('savefgmanual', 'Pages::saveFgManual');
});

// Role Monitor
$routes->group('monitor', ['filter' => 'role:monitor'], function ($routes) {
    $routes->get('view', 'Monitor::view');
});

// Role Fgstock
$routes->group('fgstock', ['filter' => 'role:fgstock'], function ($routes) {
    $routes->get('valpc', 'Fgstock::valPc');
    $routes->get('tmpidentitas', 'Fgstock::tmpIdentitas');
    $routes->get('tmphasil/(:num)', 'Fgstock::tmpHasil/$1');
    $routes->get('alldata', 'Fgstock::allData');
    $routes->get('tambahfg', 'Fgstock::tambahFg');
    $routes->get('monitor', 'Monitor::view');
    $routes->get('addmanual', 'fgstock::addManual');
});

// Role Kasie
$routes->group('kasie', ['filter' => 'role:kasie'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('tmphasil/(:num)', 'Fgstock::tmpHasil/$1');
    $routes->get('alldata', 'Fgstock::allData');
    $routes->get('setttarget', 'Kasie::setttarget');
    $routes->get('addtarget', 'kasie::addTarget');
    $routes->get('monitor', 'Monitor::view');
    $routes->get('settmesin', 'admin::settMesin');
});

// Role Admin
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('kosong', 'Admin::kosong');
    $routes->get('tmphasil/(:num)', 'Fgstock::tmpHasil/$1');
    $routes->get('alldata', 'Fgstock::allData');
    $routes->get('setttarget', 'Kasie::setttarget');
    $routes->get('tambahfg', 'Fgstock::tambahFg');
    $routes->get('addtarget', 'kasie::addTarget');
    $routes->get('monitor', 'Monitor::view');

    $routes->get('mline', 'Admin::mLine');
    $routes->post('tambahline', 'Admin::tambahLine');
    $routes->post('updateline', 'Admin::updateLine');
    $routes->post('delline', 'Admin::delLine');
    $routes->get('msku', 'Admin::mSku');
    $routes->get('addsku', 'Admin::addSku');
    $routes->post('savesku', 'Admin::saveSku');
    $routes->post('updatesku', 'Admin::updateSku');
    $routes->post('delsku', 'Admin::delSku');
    $routes->get('musers', 'Admin::mUser');
    $routes->post('deltmp', 'Admin::delTmp');
    $routes->post('updateident', 'Admin::updateIdent');
    $routes->post('adduser', 'Admin::addUser');
    $routes->post('updateuser', 'Admin::updateUser');
    $routes->post('deluser', 'Admin::delUser');
    $routes->get('addmanual', 'fgstock::addManual');
    $routes->get('settmesin', 'admin::settMesin');
    // $routes->post('cetaktmphasil', 'fgstock::cetakTmphasil');
});
