<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Color Admin | POS - Counter Checkout System</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/vendor.min.css" rel="stylesheet" />
    <link href="assets/css/default/apps.min.css" rel="stylesheet" />

</head>

<body class='pace-top'>

    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>


    <div id="app" class="app app-content-full-height app-without-header app-without-sidebar bg-white">

        <div id="content" class="app-content p-0">

            <div class="pos pos-counter" id="pos-counter">

                <div class="pos-counter-header">
                    <div class="logo">
                        <a href="pos_counter_checkout.html">
                            <div class="logo-img"><img src="../assets/img/pos/logo.svg" /></div>
                            <div class="logo-text">Pine & Dine</div>
                        </a>
                    </div>
                    <div class="time" id="time">00:00</div>
                    <div class="nav">
                        <div class="nav-item">
                            <a href="pos_kitchen_order.html" class="nav-link">
                                <svg viewBox="0 0 16 16" class="nav-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.161 8a6.84 6.84 0 1 0 6.842-6.84.58.58 0 0 1 0-1.16 8 8 0 1 1-6.556 3.412l-.663-.577a.58.58 0 0 1 .227-.997l2.52-.69a.58.58 0 0 1 .728.633l-.332 2.592a.58.58 0 0 1-.956.364l-.643-.56A6.812 6.812 0 0 0 1.16 8zm5.48-.079V5.277h1.57c.881 0 1.416.499 1.416 1.32 0 .84-.504 1.324-1.386 1.324h-1.6zm0 3.75V8.843h1.57l1.498 2.828h1.314L9.377 8.665c.897-.3 1.427-1.106 1.427-2.1 0-1.37-.943-2.246-2.456-2.246H5.5v7.352h1.141z" />
                                </svg>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="pos_table_booking.html" class="nav-link">
                                <svg viewBox="0 0 16 16" class="nav-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                    <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                </svg>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="pos_menu_stock.html" class="nav-link">
                                <svg viewBox="0 0 16 16" class="nav-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path fill-rule="evenodd" d="M7.5 7.793V1h1v6.5H15v1H8.207l-4.853 4.854-.708-.708L7.5 7.793z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="pos-counter-body">

                    <div class="pos-counter-content">
                        <div class="pos-counter-content-container" data-scrollbar="true" data-height="100%" data-skip-mobile="true">
                            <div class="table-row">
                                <div class="table in-use selected">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">1</div>
                                            <div class="order"><span>9 orders</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">4 / 4</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">35:20</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">$318.20</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">Unpaid</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table in-use">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">2</div>
                                            <div class="order"><span>12 orders</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">6 / 8</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">12:69</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">$682.20</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">Unpaid</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">3</div>
                                            <div class="order"><span>max 6 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 6</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">4</div>
                                            <div class="order"><span>max 4 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 4</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">5</div>
                                            <div class="order"><span>max 4 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 4</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table in-use">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">6</div>
                                            <div class="order"><span>3 orders</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">3 / 6</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">20:52</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">$56.49</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">unpaid</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table in-use">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">7</div>
                                            <div class="order"><span>6 order</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">3 / 4</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">58:40</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">$329.02</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col text-yellow">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-check-circle"></i>
                                                    </span>
                                                    <span class="text">Paid</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table in-use">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">8</div>
                                            <div class="order"><span>0 order</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">2 / 4</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">05:12</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">$0.00</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">unpaid</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table in-use">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">9</div>
                                            <div class="order"><span>4 order</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">2 / 4</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">52:58</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">$49.50</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">Unpaid</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table in-use">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">10</div>
                                            <div class="order"><span>12 order</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">9 / 12</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">66:69</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">$768.24</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col text-yellow">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-check-circle"></i>
                                                    </span>
                                                    <span class="text">Paid</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table disabled">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">11</div>
                                            <div class="order"><span>Reserved for Sean</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 4</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">12</div>
                                            <div class="order"><span>max 6 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 6</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">13</div>
                                            <div class="order"><span>max 6 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 6</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">14</div>
                                            <div class="order"><span>max 6 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 6</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">15</div>
                                            <div class="order"><span>max 6 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 6</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">16</div>
                                            <div class="order"><span>max 6 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 6</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">17</div>
                                            <div class="order"><span>max 6 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 6</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">18</div>
                                            <div class="order"><span>max 6 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 6</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">19</div>
                                            <div class="order"><span>max 6 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 6</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="table available">
                                    <a href="#" class="table-container" data-toggle="select-table">
                                        <div class="table-status"></div>
                                        <div class="table-name">
                                            <div class="name">Table</div>
                                            <div class="no">20</div>
                                            <div class="order"><span>max 6 pax</span></div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-user"></i>
                                                    </span>
                                                    <span class="text">0 / 6</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-info-row">
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-hand-point-up"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                            <div class="table-info-col">
                                                <div class="table-info-container">
                                                    <span class="icon">
                                                        <i class="fa fa-dollar-sign"></i>
                                                    </span>
                                                    <span class="text">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="pos-counter-sidebar" id="pos-counter-sidebar">
                        <div class="pos-sidebar-header">
                            <div class="back-btn">
                                <button type="button" data-dismiss-class="pos-mobile-sidebar-toggled" data-target="#pos-counter" class="btn">
                                    <svg viewBox="0 0 16 16" class="bi bi-chevron-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="icon"><img src="../assets/img/pos/icon-table.svg" /></div>
                            <div class="title">Table 00</div>
                            <div class="order">Order: <b>#0000</b></div>
                        </div>
                        <div class="pos-sidebar-body">
                            <div class="pos-table" data-id="pos-table-info">
                                <div class="row pos-table-row">
                                    <div class="col-8">
                                        <div class="pos-product-thumb">
                                            <div class="img" style="background-image: url(../assets/img/pos/product-2.jpg)"></div>
                                            <div class="info">
                                                <div class="title">Grill Pork Chop</div>
                                                <div class="desc">- size: large</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 total-qty">x1</div>
                                    <div class="col-3 total-price">$12.99</div>
                                </div>
                                <div class="row pos-table-row">
                                    <div class="col-8">
                                        <div class="pos-product-thumb">
                                            <div class="img" style="background-image: url(../assets/img/pos/product-8.jpg)"></div>
                                            <div class="info">
                                                <div class="title">Orange Juice</div>
                                                <div class="desc">
                                                    - size: large<br />
                                                    - less ice
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 total-qty">x2</div>
                                    <div class="col-3 total-price">$10.00</div>
                                </div>
                                <div class="row pos-table-row">
                                    <div class="col-8">
                                        <div class="pos-product-thumb">
                                            <div class="img" style="background-image: url(../assets/img/pos/product-13.jpg)"></div>
                                            <div class="info">
                                                <div class="title">Vanilla Ice-cream</div>
                                                <div class="desc">
                                                    - scoop: 1 <br />
                                                    - flavour: vanilla
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 total-qty">x1</div>
                                    <div class="col-3 total-price">$3.99</div>
                                </div>
                                <div class="row pos-table-row">
                                    <div class="col-8">
                                        <div class="pos-product-thumb">
                                            <div class="img" style="background-image: url(../assets/img/pos/product-1.jpg)"></div>
                                            <div class="info">
                                                <div class="title">Grill chicken chop</div>
                                                <div class="desc">
                                                    - size: large<br />
                                                    - spicy: medium
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 total-qty">x1</div>
                                    <div class="col-3 total-price">$10.99</div>
                                </div>
                                <div class="row pos-table-row">
                                    <div class="col-8">
                                        <div class="pos-product-thumb">
                                            <div class="img" style="background-image: url(../assets/img/pos/product-10.jpg)"></div>
                                            <div class="info">
                                                <div class="title">Mushroom Soup</div>
                                                <div class="desc">
                                                    - size: large<br />
                                                    - more cheese
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 total-qty">x1</div>
                                    <div class="col-3 total-price">$3.99</div>
                                </div>
                                <div class="row pos-table-row">
                                    <div class="col-8">
                                        <div class="pos-product-thumb">
                                            <div class="img" style="background-image: url(../assets/img/pos/product-5.jpg)"></div>
                                            <div class="info">
                                                <div class="title">Hawaiian Pizza</div>
                                                <div class="desc">
                                                    - size: large<br />
                                                    - more onion
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 total-qty">x1</div>
                                    <div class="col-3 total-price">$15.00</div>
                                </div>
                                <div class="row pos-table-row">
                                    <div class="col-8">
                                        <div class="pos-product-thumb">
                                            <div class="img" style="background-image: url(../assets/img/pos/product-15.jpg)"></div>
                                            <div class="info">
                                                <div class="title">Perfect Yeast Doughnuts</div>
                                                <div class="desc">
                                                    - size: 1 set<br />
                                                    - flavour: random
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 total-qty">x1</div>
                                    <div class="col-3 total-price">$2.99</div>
                                </div>
                                <div class="row pos-table-row">
                                    <div class="col-8">
                                        <div class="pos-product-thumb">
                                            <div class="img" style="background-image: url(../assets/img/pos/product-14.jpg)"></div>
                                            <div class="info">
                                                <div class="title">Macarons</div>
                                                <div class="desc">
                                                    - size: 1 set<br />
                                                    - flavour: random
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 total-qty">x1</div>
                                    <div class="col-3 total-price">$4.99</div>
                                </div>
                            </div>
                            <div class="h-100 d-none align-items-center justify-content-center text-center p-20" data-id="pos-table-empty">
                                <div>
                                    <div class="mb-3">
                                        <svg width="6em" height="6em" viewBox="0 0 16 16" class="text-gray-300" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z" />
                                            <path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z" />
                                        </svg>
                                    </div>
                                    <h4>No table selected</h4>
                                </div>
                            </div>
                        </div>
                        <div class="pos-sidebar-footer">
                            <div class="subtotal">
                                <div class="text">Subtotal</div>
                                <div class="price" data-id="price-subtotal">$64.94</div>
                            </div>
                            <div class="taxes">
                                <div class="text">Taxes (6%)</div>
                                <div class="price" data-id="price-subtotal">$3.90</div>
                            </div>
                            <div class="total">
                                <div class="text">Total</div>
                                <div class="price" data-id="price-subtotal">$68.84</div>
                            </div>
                            <div class="btn-row">
                                <a href="#" class="btn btn-default w-150px">
                                    <div class="icon"><i class="fa fa-qrcode fa-fw fa-lg"></i></div>
                                    <div>Digital Wallet</div>
                                </a>
                                <a href="#" class="btn btn-default w-150px">
                                    <div class="icon"><i class="fab fa-cc-visa fa-fw fa-lg"></i></div>
                                    <div>Credit Card</div>
                                </a>
                                <a href="#" class="btn btn-success">
                                    <div class="icon"><i class="fa fa-cash-register fa-fw fa-lg"></i></div>
                                    <div>Pay by Cash</div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        <div class="theme-panel">
            <a href="javascript:;" data-toggle="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content" data-scrollbar="true" data-height="100%">
                <h5>App Settings</h5>

                <div class="theme-list">
                    <div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-red" data-theme-class="theme-red" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Red">&nbsp;</a></div>
                    <div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-pink" data-theme-class="theme-pink" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Pink">&nbsp;</a></div>
                    <div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-orange" data-theme-class="theme-orange" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Orange">&nbsp;</a></div>
                    <div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-yellow" data-theme-class="theme-yellow" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Yellow">&nbsp;</a></div>
                    <div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-lime" data-theme-class="theme-lime" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Lime">&nbsp;</a></div>
                    <div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-green" data-theme-class="theme-green" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Green">&nbsp;</a></div>
                    <div class="theme-list-item active"><a href="javascript:;" class="theme-list-link bg-teal" data-theme-class="" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Default">&nbsp;</a></div>
                    <div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-cyan" data-theme-class="theme-cyan" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Cyan">&nbsp;</a></div>
                    <div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-blue" data-theme-class="theme-blue" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Blue">&nbsp;</a></div>
                    <div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-purple" data-theme-class="theme-purple" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Purple">&nbsp;</a></div>
                    <div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-indigo" data-theme-class="theme-indigo" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Indigo">&nbsp;</a></div>
                    <div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-black" data-theme-class="theme-gray-600" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Black">&nbsp;</a></div>
                </div>

                <div class="theme-panel-divider"></div>
                <div class="row mt-10px">
                    <div class="col-8 control-label text-dark fw-bold">
                        <div>Dark Mode <span class="badge bg-primary ms-1 py-2px position-relative" style="top: -1px;">NEW</span></div>
                        <div class="lh-14">
                            <small class="text-dark opacity-50">
                                Adjust the appearance to reduce glare and give your eyes a break.
                            </small>
                        </div>
                    </div>
                    <div class="col-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input type="checkbox" class="form-check-input" name="app-theme-dark-mode" id="appThemeDarkMode" value="1" />
                            <label class="form-check-label" for="appThemeDarkMode">&nbsp;</label>
                        </div>
                    </div>
                </div>
                <div class="theme-panel-divider"></div>

                <div class="row mt-10px align-items-center">
                    <div class="col-8 control-label text-dark fw-bold">Header Fixed</div>
                    <div class="col-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input type="checkbox" class="form-check-input" name="app-header-fixed" id="appHeaderFixed" value="1" checked />
                            <label class="form-check-label" for="appHeaderFixed">&nbsp;</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-10px align-items-center">
                    <div class="col-8 control-label text-dark fw-bold">Header Inverse</div>
                    <div class="col-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input type="checkbox" class="form-check-input" name="app-header-inverse" id="appHeaderInverse" value="1" />
                            <label class="form-check-label" for="appHeaderInverse">&nbsp;</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-10px align-items-center">
                    <div class="col-8 control-label text-dark fw-bold">Sidebar Fixed</div>
                    <div class="col-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input type="checkbox" class="form-check-input" name="app-sidebar-fixed" id="appSidebarFixed" value="1" checked />
                            <label class="form-check-label" for="appSidebarFixed">&nbsp;</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-10px align-items-center">
                    <div class="col-8 control-label text-dark fw-bold">Sidebar Grid</div>
                    <div class="col-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input type="checkbox" class="form-check-input" name="app-sidebar-grid" id="appSidebarGrid" value="1" />
                            <label class="form-check-label" for="appSidebarGrid">&nbsp;</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-10px align-items-center">
                    <div class="col-md-8 control-label text-dark fw-bold">Gradient Enabled</div>
                    <div class="col-md-4 d-flex">
                        <div class="form-check form-switch ms-auto mb-0">
                            <input type="checkbox" class="form-check-input" name="app-gradient-enabled" id="appGradientEnabled" value="1" />
                            <label class="form-check-label" for="appGradientEnabled">&nbsp;</label>
                        </div>
                    </div>
                </div>

                <div class="theme-panel-divider"></div>
                <h5>Admin Design (5)</h5>

                <div class="theme-version">
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/html/index_v2.html" class="theme-version-link active">
                            <span style="background-image: url(../assets/img/theme/default.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/transparent/index_v2.html" class="theme-version-link">
                            <span style="background-image: url(../assets/img/theme/transparent.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/apple/index_v2.html" class="theme-version-link">
                            <span style="background-image: url(../assets/img/theme/apple.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/material/index_v2.html" class="theme-version-link">
                            <span style="background-image: url(../assets/img/theme/material.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/facebook/index_v2.html" class="theme-version-link">
                            <span style="background-image: url(../assets/img/theme/facebook.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/google/index_v2.html" class="theme-version-link">
                            <span style="background-image: url(../assets/img/theme/google.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                </div>

                <div class="theme-panel-divider"></div>
                <h5>Language Version (7)</h5>

                <div class="theme-version">
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/html/" class="theme-version-link active">
                            <span style="background-image: url(../assets/img/version/html.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/ajax/" class="theme-version-link">
                            <span style="background-image: url(../assets/img/version/ajax.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/angularjs/" class="theme-version-link">
                            <span style="background-image: url(../assets/img/version/angular1x.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/angularjs14/" class="theme-version-link">
                            <span style="background-image: url(../assets/img/version/angular10x.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="javascript:alert('Laravel Version only available in downloaded version.');" class="theme-version-link">
                            <span style="background-image: url(../assets/img/version/laravel.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/vuejs/" class="theme-version-link">
                            <span style="background-image: url(../assets/img/version/vuejs.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/admin/reactjs/" class="theme-version-link">
                            <span style="background-image: url(../assets/img/version/reactjs.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="javascript:alert('.NET Core 6.0 MVC Version only available in downloaded version.');" class="theme-version-link">
                            <span style="background-image: url(../assets/img/version/dotnet.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                </div>

                <div class="theme-panel-divider"></div>
                <h5>Frontend Design (5)</h5>

                <div class="theme-version">
                    <div class="theme-version-item">
                        <a href="/color-admin/frontend/one-page-parallax/" class="theme-version-link">
                            <span style="background-image: url(../assets/img/theme/one-page-parallax.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/frontend/e-commerce/" class="theme-version-link">
                            <span style="background-image: url(../assets/img/theme/e-commerce.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/frontend/blog/" class="theme-version-link">
                            <span style="background-image: url(../assets/img/theme/blog.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/frontend/forum/" class="theme-version-link">
                            <span style="background-image: url(../assets/img/theme/forum.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                    <div class="theme-version-item">
                        <a href="/color-admin/frontend/corporate/" class="theme-version-link">
                            <span style="background-image: url(../assets/img/theme/corporate.jpg);" class="theme-version-cover"></span>
                        </a>
                    </div>
                </div>

                <div class="theme-panel-divider"></div>
                <a href="/color-admin/documentation/" class="btn btn-dark d-block w-100 rounded-pill mb-10px" target="_blank"><b>Documentation</b></a>
                <a href="javascript:;" class="btn btn-default d-block w-100 rounded-pill" data-toggle="reset-local-storage"><b>Reset Local Storage</b></a>
            </div>
        </div>


        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

    </div>


    <script src="assets/js/vendor.min.js" type="e91d9cfede57f6783da95b65-text/javascript"></script>
    <script src="assets/js/app.min.js" type="e91d9cfede57f6783da95b65-text/javascript"></script>


    <script src="assets/js/demo/pos-counter-checkout.demo.js" type="e91d9cfede57f6783da95b65-text/javascript"></script>

    <script type="e91d9cfede57f6783da95b65-text/javascript">
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-53034621-1', 'auto');
        ga('send', 'pageview');
    </script>
    <script src="/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="e91d9cfede57f6783da95b65-|49" defer=""></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"76536daafe049f8c","version":"2022.11.0","r":1,"token":"4db8c6ef997743fda032d4f73cfeff63","si":100}' crossorigin="anonymous"></script>
</body>

</html>