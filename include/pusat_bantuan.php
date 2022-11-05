<!-- begin pusat-bantuan -->
<style>
	.pusat-bantuan.pusat-bantuan-lg.active {
		right: 0;
	}

	.pusat-bantuan.pusat-bantuan-lg {
		top: 0;
		bottom: 0;
		/* width: 260px; */
		width: 430px;
		right: -260px;
	}

	.pusat-bantuan.active {
		right: 0;
		-webkit-box-shadow: 0 5px 25px rgb(0 0 0 / 30%);
		box-shadow: 0 5px 25px rgb(0 0 0 / 30%);
	}

	.pusat-bantuan {
		position: fixed;
		right: -175px;
		top: 150px;
		z-index: 1020;
		background: #fff;
		padding: 15px;
		width: 175px;
		-webkit-transition: right .2s linear;
		-moz-transition: right .2s linear;
		-ms-transition: right .2s linear;
		-o-transition: right .2s linear;
		transition: right .2s linear;
		-webkit-border-radius: 4px 0 0 4px;
		border-radius: 4px 0 0 4px;
	}

	.line-page-PB {
		height: 0.5px;
		margin: 10px 0px 15px 0px;
		background: #444e66;
	}

	.PB-x {
		display: flex;
		justify-content: space-between;
		align-content: center;
		align-items: center;
	}

	.btn-PB {
		color: #212529;
		background-color: #f1f3f4;
		border-color: #f1f3f4;
		-webkit-box-shadow: 0;
		box-shadow: 0;
		border-radius: 50%;
	}

	/*  */
	.mk-drawer-menu {
		padding: 0;
		margin: 0;
		-webkit-transition: all 0.3s ease;
		transition: all 0.3s ease;
		-webkit-transform: translateX(0);
		transform: translateX(0);
	}

	.mk-drawer-menu .mk-drawer-menu-item {
		list-style: none;
	}

	.mk-drawer-menu .mk-drawer-menu-item .mk-drawer-menu-item-link {
		position: relative;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		padding: 1em 1.5em;
		z-index: 1;
	}

	.mk-drawer-menu .mk-drawer-menu-item .mk-drawer-item-icon {
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		height: 48px;
		width: 48px;
		margin-right: 1em;
		border-radius: 50%;
		-webkit-transition: all .3s ease;
		transition: all .3s ease;
		-webkit-box-flex: 0;
		-ms-flex: 0 0 48px;
		flex: 0 0 48px;
	}
</style>
<div class="pusat-bantuan pusat-bantuan-lg active" id="divPB" style="display: none;">
	<div class="pusat-bantuan-content">
		<div class="PB-x">
			<div>
				<h5 style="margin-top: 0px;margin-bottom: 0px;">Pusat Bantuan</h5>
			</div>
			<div>
				<button onClick="showHidePB('divPB')" class="btn btn-PB"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="line-page-PB"></div>
		<div class="row m-t-10">
			<div class="col-md-12">
				<ul class="mk-drawer-menu drawer-main-menu" id="drawer-main-menu">
					<li class="mk-drawer-menu-item mk-bg-hv-primary hc-mx-trigger" content-name="whats-new" data-drawer-title="What's new" data-mixpanel-event="whats new">
						<div class="mk-drawer-menu-item-link">
							<div class="mk-drawer-item-icon mk-hv-child">
								<!--?xml version="1.0" encoding="UTF-8"?-->
								<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<title>ic-whats-new</title>
									<defs>
										<path d="M11,20 L9.651,20 L7.6,15 L11,15 L11,20 Z M20,3 C20,5 14.9,6 12,6 L6.5,6 C4,6 2,8 2,10.5 C2,12.6 3.4,14.3 5.3,14.8 L7.8,20.8 C8.1,21.5 8.8,22 9.6,22 L11,22 C12.1,22 13,21.1 13,20 L13,15.1 C16,15.401 20,16.201 20,18 C20,18.5 20.5,19 21,19 C21.5,19 22,18.5 22,18 L22,3 C22,2.5 21.5,2 21,2 C20.5,2 20,2.5 20,3 Z" id="path-1"></path>
									</defs>
									<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<g id="Artboard" transform="translate(-1056.000000, -92.000000)">
											<g id="Group" transform="translate(1056.000000, 92.000000)">
												<mask id="mask-2" fill="white">
													<use xlink:href="#path-1"></use>
												</mask>
												<use id="Color" fill="#777777" fill-rule="nonzero" xlink:href="#path-1"></use>
											</g>
										</g>
									</g>
								</svg>
							</div>
							<div class="mk-drawer-item-content">
								<p class="d-flex item-content-title mb-0">
									What's new
									<span class="mk-dot ml-1 d-none" id="whats-new-notif"></span>
								</p>
								<small class="text-muted">
									Info produk terkini dari Jurnal
								</small>
							</div>
						</div>
					</li>
					<li class="mk-drawer-menu-item mk-bg-hv-warning hc-mx-trigger" content-name="tour-on-demand" data-drawer-title="Pusat Panduan" data-mixpanel-event="guide center">
						<div class="mk-drawer-menu-item-link">
							<div class="mk-drawer-item-icon mk-hv-child">
								<!--?xml version="1.0" encoding="UTF-8"?-->
								<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<title>ic-tour</title>
									<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<g id="Artboard" transform="translate(-1056.000000, -252.000000)" fill="#777777" fill-rule="nonzero">
											<g id="Combined-Shape" transform="translate(1056.000000, 252.000000)">
												<path d="M14,19 L14,20 C14,21.1045695 13.1045695,22 12,22 C10.8954305,22 10,21.1045695 10,20 L10,19 L14,19 Z M19.9810945,12 L22,15.0000279 L19.9810945,18 L7,18 C6.44771525,18 6,17.5522847 6,17 L6,17 L6,13 C6,12.4477153 6.44771525,12 7,12 L7,12 L19.9810945,12 Z M17,14 L10,14 C9.44771525,14 9,14.4477153 9,15 C9,15.5522847 9.44771525,16 10,16 L10,16 L17,16 C17.5522847,16 18,15.5522847 18,15 C18,14.4477153 17.5522847,14 17,14 L17,14 Z M17.0015469,5 C17.5538316,5 18.0015469,5.44771525 18.0015469,6 L18.0015469,6 L18.0015469,10 C18.0015469,10.5522847 17.5538316,11 17.0015469,11 L17.0015469,11 L4.02045238,11 L2.00154687,7.99997205 L4.02045238,5 Z M14.0015469,7 L7.00154687,7 C6.44926213,7 6.00154687,7.44771525 6.00154687,8 C6.00154687,8.55228475 6.44926213,9 7.00154687,9 L7.00154687,9 L14.0015469,9 C14.5538316,9 15.0015469,8.55228475 15.0015469,8 C15.0015469,7.44771525 14.5538316,7 14.0015469,7 L14.0015469,7 Z M12,2 C13.0543618,2 13.9181651,2.81587779 13.9945143,3.85073766 L14,4 L10,4 C10,2.8954305 10.8954305,2 12,2 Z"></path>
											</g>
										</g>
									</g>
								</svg>
							</div>
							<div class="mk-drawer-item-content">
								<p class="item-content-title mb-0">
									Pusat Panduan
								</p>
								<small class="text-muted">
									Penggunaan Jurnal berdasarkan industri
								</small>
							</div>
						</div>
					</li>
					<li class="mk-drawer-menu-item mk-bg-hv-neutral">
						<a class="mk-drawer-menu-item-link hc-mx-trigger" data-mixpanel-event="guidebook" href="https://www.jurnal.id/id/guidebooks/?utm_source=digital%20-%20trial%20direct%20sign%20up%20(e)&amp;utm_medium=referral%20-%20in-app&amp;utm_campaign=jurnal%20in%20app%20access%20to%20blog%20or%20guidebook" target="_blank">
							<div class="mk-drawer-item-icon mk-hv-child">
								<!--?xml version="1.0" encoding="UTF-8"?-->
								<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<title>ic-guidebook</title>
									<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<g id="Artboard" transform="translate(-1056.000000, -412.000000)" fill="#777777" fill-rule="nonzero">
											<g id="Color" transform="translate(1056.000000, 412.000000)">
												<path d="M13.1874878,4.21321455 L13.3950393,4.29457687 L21.7564854,7.87972156 C21.8510389,7.92026338 21.9285116,7.99248416 21.9755803,8.08396399 C22.073415,8.2741098 22.0201656,8.50215063 21.8597442,8.63109457 L21.7845587,8.67988971 L20.85,9.16 L20.8507246,18.3458323 C21.3275147,18.5195457 21.6791457,18.9656452 21.7289847,19.5023668 L21.7350617,19.6339286 C21.7350617,20.388389 21.1407165,21 20.4075545,21 C19.6743926,21 19.0800474,20.388389 19.0800474,19.6339286 C19.0800474,19.0392362 19.4493229,18.5332984 19.9647824,18.3456874 L19.965,9.615 L13.6196258,12.8809524 C12.6709681,13.3690606 11.5568201,13.4016011 10.586097,12.978574 L10.3803927,12.8809524 L2.21545985,8.67988971 C2.12398002,8.63282104 2.05175924,8.55534839 2.01121742,8.46079481 C1.92561144,8.26114044 1.99828143,8.03340177 2.17323878,7.91761876 L2.24353315,7.87972156 L10.6049792,4.29457687 C11.4272599,3.94200683 12.3497849,3.91488606 13.1874878,4.21321455 Z M18.1949759,12.3482143 L18.1950426,16.5981877 C18.1950417,17.1076334 17.9755339,17.5923772 17.592658,17.9284442 C15.9514498,19.3690052 14.0872336,20.0892857 12.0000093,20.0892857 C9.91277352,20.0892857 8.04854828,19.3689973 6.40733353,17.9284206 C6.02447929,17.5923412 5.80497589,17.107605 5.80497589,16.5981674 L5.80497589,12.3482143 L10.3803927,14.702381 C11.3968117,15.225354 12.6032068,15.225354 13.6196258,14.702381 L18.1949759,12.3482143 Z"></path>
											</g>
										</g>
									</g>
								</svg>
							</div>
							<div class="mk-drawer-item-content">
								<p class="item-content-title mb-0">
									Buku Panduan
								</p>
								<small class="text-muted">
									Panduan lengkap penggunaan Jurnal
								</small>
							</div>
						</a>
					</li>
					<li class="mk-drawer-menu-item mk-bg-hv-danger hc-mx-trigger" content-name="blog" data-drawer-title="Jurnal Entrepreneur" data-mixpanel-event="jurnal entrepreneur">
						<div class="mk-drawer-menu-item-link">
							<div class="mk-drawer-item-icon mk-hv-child">
								<!--?xml version="1.0" encoding="UTF-8"?-->
								<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<title>ic-blog</title>
									<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<g id="Artboard" transform="translate(-1056.000000, -332.000000)" fill="#777777" fill-rule="nonzero">
											<g id="Color" transform="translate(1056.000000, 332.000000)">
												<path d="M5,11 L5,20.5 C5,21.3284271 4.32842712,22 3.5,22 C2.67157288,22 2,21.3284271 2,20.5 L2,20.5 L2,14 C2,12.3431458 3.34314575,11 5,11 L5,11 Z M19,2 C20.6568542,2 22,3.34314575 22,5 L22,5 L22,19 C22,20.6568542 20.6568542,22 19,22 L19,22 L4.5,22 L4.64446001,21.9931334 C5.40511192,21.9204487 6,21.2796961 6,20.5 L6,20.5 L6,5 C6,3.34314575 7.34314575,2 9,2 L9,2 Z M12,15 L10,15 L9.88337887,15.0067277 C9.38604019,15.0644928 9,15.4871642 9,16 L9,16 L9,18 L9.00672773,18.1166211 C9.06449284,18.6139598 9.48716416,19 10,19 L10,19 L12,19 C12.5522847,19 13,18.5522847 13,18 L13,18 L13,16 L12.9932723,15.8833789 C12.9355072,15.3860402 12.5128358,15 12,15 L12,15 Z M18,11 L10,11 L9.88337887,11.0067277 C9.38604019,11.0644928 9,11.4871642 9,12 C9,12.5522847 9.44771525,13 10,13 L10,13 L18,13 C18.5522847,13 19,12.5522847 19,12 C19,11.4477153 18.5522847,11 18,11 L18,11 Z M12,7 L10,7 L9.88337887,7.00672773 C9.38604019,7.06449284 9,7.48716416 9,8 C9,8.55228475 9.44771525,9 10,9 L10,9 L12,9 C12.5522847,9 13,8.55228475 13,8 C13,7.44771525 12.5522847,7 12,7 L12,7 Z" transform="translate(12.000000, 12.000000) scale(1, -1) translate(-12.000000, -12.000000) "></path>
											</g>
										</g>
									</g>
								</svg>
							</div>
							<div class="mk-drawer-item-content">
								<p class="item-content-title mb-0">
									Jurnal Entrepreneur
								</p>
								<small class="text-muted">
									Artikel terkini tentang Jurnal
								</small>
							</div>
						</div>
					</li>
					<li class="mk-drawer-menu-item mk-bg-hv-help hc-mx-trigger" content-name="live-train" data-drawer-title="Live Training Jurnal" data-mixpanel-event="live training">
						<div class="mk-drawer-menu-item-link">
							<div class="mk-drawer-item-icon mk-hv-child">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M18.4722 15.8374L16.9839 16.1783C16.6501 16.257 16.3885 16.5017 16.3164 16.8252L16.0007 18.1102C15.8293 18.8095 14.9092 19.028 14.4311 18.4773L11.7341 15.4702C11.5176 15.2255 11.6349 14.8409 11.9596 14.7622C13.5562 14.3863 14.9904 13.5209 16.0458 12.2884C16.2171 12.0873 16.5238 12.0611 16.7133 12.2447L18.7157 14.1853C19.4013 14.8496 19.1577 15.68 18.4722 15.8374Z" fill="#777777"></path>
									<path d="M1.48532 15.8374L2.97365 16.1783C3.3074 16.257 3.56899 16.5017 3.64115 16.8252L3.95686 18.1102C4.12824 18.8095 5.0483 19.028 5.52637 18.4773L8.22342 15.4702C8.4399 15.2255 8.32264 14.8409 7.99791 14.7622C6.40133 14.3863 4.96712 13.5209 3.91176 12.2884C3.74037 12.0873 3.43368 12.0611 3.24426 12.2447L1.24177 14.1853C0.556236 14.8496 0.799782 15.68 1.48532 15.8374Z" fill="#777777"></path>
									<path d="M10.2926 0.833374C6.60693 0.833374 3.62598 3.81433 3.62598 7.50004C3.62598 8.88099 4.0355 10.1477 4.74026 11.2048C5.76883 12.7286 7.39741 13.8048 9.29264 14.081C9.61645 14.1381 9.94979 14.1667 10.2926 14.1667C10.6355 14.1667 10.9688 14.1381 11.2926 14.081C13.1879 13.8048 14.8165 12.7286 15.845 11.2048C16.5498 10.1477 16.9593 8.88099 16.9593 7.50004C16.9593 3.81433 13.9784 0.833374 10.2926 0.833374ZM13.2069 7.29052L12.4165 8.08099C12.2831 8.21433 12.2069 8.47147 12.2545 8.66195L12.4831 9.6429C12.6641 10.4143 12.2545 10.7191 11.5688 10.3096L10.6165 9.74766C10.445 9.6429 10.1593 9.6429 9.98788 9.74766L9.0355 10.3096C8.34979 10.7096 7.94026 10.4143 8.12122 9.6429L8.34979 8.66195C8.38788 8.48099 8.32122 8.21433 8.18788 8.08099L7.37836 7.29052C6.91169 6.82385 7.06407 6.35718 7.71169 6.25242L8.73074 6.08099C8.90217 6.05242 9.10217 5.90004 9.17836 5.74766L9.74026 4.62385C10.045 4.01433 10.5403 4.01433 10.845 4.62385L11.4069 5.74766C11.4831 5.90004 11.6831 6.05242 11.8641 6.08099L12.8831 6.25242C13.5212 6.35718 13.6736 6.82385 13.2069 7.29052Z" fill="#777777"></path>
								</svg>

							</div>
							<div class="mk-drawer-item-content">
								<p class="item-content-title mb-0 flex-nowrap flex-center">
									Live Training Jurnal
									<span class="mk-badge mk-badge-warning margin-left-8">Gratis!</span>
								</p>
								<small class="text-muted">
									Pelatihan diadakan oleh Mekari University
								</small>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- end pusat-bantuan -->