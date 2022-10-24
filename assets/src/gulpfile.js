/*
	TASK LIST
	------------------
	01. fonts
	02. js
	03. plugins
	
	04. default-html
	05. default-css
	06. default-css-rtl
	07. default-css-theme
	08. default-watch
	09. default-webserver
	10. default
	
	11. material-html
	12. material-css
	13. material-css-rtl
	14. material-css-theme
	15. material-watch
	16. material-webserver
	17. material
	
	18. apple-html
	19. apple-css
	20. apple-css-rtl
	21. apple-css-theme
	22. apple-watch
	23. apple-webserver
	24. apple
	
	25. transparent-html
	26. transparent-css
	27. transparent-css-rtl
	28. transparent-css-theme
	29. transparent-watch
	30. transparent-webserver
	31. transparent
	
	32. facebook-html
	33. facebook-css
	34. facebook-css-rtl
	35. facebook-css-theme
	36. facebook-watch
	37. facebook-webserver
	38. facebook
*/
var gulp       = require('gulp');
var sass       = require('gulp-sass');
var minifyCSS  = require('gulp-csso');
var concat     = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var livereload = require('gulp-livereload');
var webserver  = require('gulp-webserver');
var download   = require('gulp-download-stream');
var header     = require('gulp-header');
var merge      = require('merge-stream');
var distPath   = '../template';

// 01. fonts
gulp.task('fonts', function() {
  return gulp.src(['node_modules/@fortawesome/fontawesome-free/webfonts/*'])
  	.pipe(gulp.dest(distPath + '/assets/css/webfonts/'));
});

// 02. js
gulp.task('js', function(){
  return gulp.src([
  	'node_modules/pace-js/pace.min.js',
  	'node_modules/jquery/dist/jquery.min.js',
  	'node_modules/jquery-ui-dist/jquery-ui.min.js',
  	'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
  	'node_modules/jquery-slimscroll/jquery.slimscroll.min.js',
  	'node_modules/js-cookie/src/js.cookie.js',
  	'js/app.js',
  	])
    .pipe(sourcemaps.init())
    .pipe(concat('app.min.js'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(distPath + '/assets/js/'))
    .pipe(livereload())
});

// 03. plugins
gulp.task('plugins', function() {
	var pluginFiles = [
		'node_modules/apexcharts/dist/**',
		'node_modules/lity/dist/**',
		'node_modules/x-editable-bs4/dist/**',
		'node_modules/dropzone/dist/**',
		'node_modules/fullcalendar/dist/**',
		'node_modules/chart.js/dist/**',
		'node_modules/raphael/raphael.min.js',
		'node_modules/morris.js/morris.css',
		'node_modules/morris.js/morris.min.js',
		'node_modules/tag-it/css/**',
		'node_modules/tag-it/js/**',
		'node_modules/jquery-migrate/dist/**',
		'node_modules/jquery-mockjax/dist/**',
		'node_modules/x-editable-bs4/dist/**',
		'node_modules/blueimp-file-upload/**',
		'node_modules/blueimp-canvas-to-blob/**',
		'node_modules/blueimp-gallery/**',
		'node_modules/blueimp-load-image/**',
		'node_modules/blueimp-tmpl/**',
		'node_modules/abpetkov-powerange/dist/**',
		'node_modules/bootstrap3-wysihtml5-bower/dist/**',
		'node_modules/summernote/dist/**',
		'node_modules/parsleyjs/dist/**',
		'node_modules/smartwizard/dist/**',
		'node_modules/flot/**',
		'node_modules/ckeditor/**',
		'node_modules/jvectormap-next/jquery-jvectormap.css',
		'node_modules/jvectormap-next/jquery-jvectormap.min.js',
		'node_modules/moment/**',
		'node_modules/d3/d3.min.js',
		'node_modules/nvd3/build/**',
		'node_modules/simple-line-icons/css/**',
		'node_modules/simple-line-icons/fonts/**',
		'node_modules/jquery-knob/dist/**',
		'node_modules/sweetalert/dist/**',
		'node_modules/clipboard/dist/**',
		'node_modules/jstree/dist/**',
		'node_modules/gritter/css/**',
		'node_modules/gritter/images/**',
		'node_modules/gritter/js/**',
		'node_modules/datatables.net/js/**',
		'node_modules/datatables.net-bs4/css/**',
		'node_modules/datatables.net-bs4/js/**',
		'node_modules/datatables.net-responsive/js/**',
		'node_modules/datatables.net-responsive-bs4/css/**',
		'node_modules/datatables.net-responsive-bs4/js/**',
		'node_modules/datatables.net-autofill/js/**',
		'node_modules/datatables.net-autofill-bs4/css/**',
		'node_modules/datatables.net-autofill-bs4/js/**',
		'node_modules/datatables.net-buttons/js/**',
		'node_modules/datatables.net-buttons-bs4/css/**',
		'node_modules/datatables.net-buttons-bs4/js/**',
		'node_modules/datatables.net-colreorder/js/**',
		'node_modules/datatables.net-colreorder-bs4/css/**',
		'node_modules/datatables.net-colreorder-bs4/js/**',
		'node_modules/datatables.net-fixedcolumns/js/**',
		'node_modules/datatables.net-fixedcolumns-bs4/css/**',
		'node_modules/datatables.net-fixedcolumns-bs4/js/**',
		'node_modules/datatables.net-fixedheader/js/**',
		'node_modules/datatables.net-fixedheader-bs4/css/**',
		'node_modules/datatables.net-fixedheader-bs4/js/**',
		'node_modules/datatables.net-keytable/js/**',
		'node_modules/datatables.net-keytable-bs4/css/**',
		'node_modules/datatables.net-keytable-bs4/js/**',
		'node_modules/datatables.net-rowreorder/js/**',
		'node_modules/datatables.net-rowreorder-bs4/css/**',
		'node_modules/datatables.net-rowreorder-bs4/js/**',
		'node_modules/datatables.net-scroller/js/**',
		'node_modules/datatables.net-scroller-bs4/css/**',
		'node_modules/datatables.net-scroller-bs4/js/**',
		'node_modules/datatables.net-select/js/**',
		'node_modules/datatables.net-select-bs4/css/**',
		'node_modules/datatables.net-select-bs4/js/**',
		'node_modules/pdfmake/build/**',
		'node_modules/jszip/dist/**',
		'node_modules/bootstrap-datepicker/dist/**',
		'node_modules/bootstrap-colorpicker/dist/**',
		'node_modules/bootstrap-select/dist/**',
		'node_modules/bootstrap-show-password/dist/**',
		'node_modules/bootstrap-timepicker/css/**',
		'node_modules/bootstrap-timepicker/js/**',
		'node_modules/@danielfarrell/bootstrap-combobox/**',
		'node_modules/pwstrength-bootstrap/dist/**',
		'node_modules/isotope-layout/dist/**',
		'node_modules/lightbox2/dist/**',
		'node_modules/jquery-simplecolorpicker/**',
		'node_modules/eonasdan-bootstrap-datetimepicker/build/**',
		'node_modules/select2/dist/**',
		'node_modules/jquery.maskedinput/src/**',
		'node_modules/ion-rangeslider/css/**',
		'node_modules/ion-rangeslider/js/**',
		'node_modules/bootstrap-daterangepicker/daterangepicker.css',
		'node_modules/bootstrap-daterangepicker/daterangepicker.js',
		'node_modules/flag-icon-css/css/**',
		'node_modules/flag-icon-css/flags/**',
		'node_modules/jquery-sparkline/jquery.sparkline.min.js',
		'node_modules/bootstrap-social/bootstrap-social.css',
		'node_modules/intro.js/minified/**',
		'node_modules/angular/**',
		'node_modules/angular-ui-router/release/**',
		'node_modules/angular-ui-bootstrap/dist/**',
		'node_modules/oclazyload/dist/**'
	];
	gulp.src(pluginFiles, { base: './node_modules/' })
		.pipe(gulp.dest(distPath + '/assets/plugins'));
		
	download([
		'https://raw.githubusercontent.com/highlightjs/cdn-release/master/build/highlight.min.js'
	]).pipe(gulp.dest(distPath + '/assets/plugins/highlight.js/'));
	download([
		'https://raw.githubusercontent.com/abpetkov/switchery/master/dist/switchery.min.css',
		'https://raw.githubusercontent.com/abpetkov/switchery/master/dist/switchery.min.js'
	]).pipe(gulp.dest(distPath + '/assets/plugins/switchery/'));
	download([
		'https://raw.githubusercontent.com/kbwood/countdown/master/dist/js/jquery.plugin.min.js',
		'https://raw.githubusercontent.com/kbwood/countdown/master/dist/js/jquery.countdown.min.js',
		'https://raw.githubusercontent.com/kbwood/countdown/master/dist/css/jquery.countdown.css'
	]).pipe(gulp.dest(distPath + '/assets/plugins/countdown/'));
	download([
		'https://raw.githubusercontent.com/seyDoggy/superbox/master/js/jquery.superbox.min.js',
		'https://raw.githubusercontent.com/seyDoggy/superbox/master/css/superbox.min.css'
	]).pipe(gulp.dest(distPath + '/assets/plugins/superbox/'));
	download([
		'https://raw.githubusercontent.com/seyDoggy/superbox/master/css/font/superboxicons.eot',
		'https://raw.githubusercontent.com/seyDoggy/superbox/master/css/font/superboxicons.svg',
		'https://raw.githubusercontent.com/seyDoggy/superbox/master/css/font/superboxicons.ttf',
		'https://raw.githubusercontent.com/seyDoggy/superbox/master/css/font/superboxicons.woff'
	]).pipe(gulp.dest(distPath + '/assets/plugins/superbox/font/'));
	download([
		'http://jvectormap.com/js/jquery-jvectormap-world-mill.js'
	]).pipe(gulp.dest(distPath + '/assets/plugins/jvectormap-next/'));
	download([
		'https://unpkg.com/ionicons@4.2.6/dist/css/ionicons.min.css'
	]).pipe(gulp.dest(distPath + '/assets/plugins/ionicons/css/'));
	download([
		'https://unpkg.com/ionicons@4.2.6/dist/fonts/ionicons.eot',
		'https://unpkg.com/ionicons@4.2.6/dist/fonts/ionicons.woff2',
		'https://unpkg.com/ionicons@4.2.6/dist/fonts/ionicons.woff',
		'https://unpkg.com/ionicons@4.2.6/dist/fonts/ionicons.ttf',
		'https://unpkg.com/ionicons@4.2.6/dist/fonts/ionicons.svg'
	]).pipe(gulp.dest(distPath + '/assets/plugins/ionicons/fonts'));
	download([
		'http://lab.xero.nu/bootstrap_calendar/lib/css/bootstrap_calendar.css'
	]).pipe(gulp.dest(distPath + '/assets/plugins/bootstrap-calendar/css/'));
	download([
		'http://lab.xero.nu/bootstrap_calendar/lib/js/bootstrap_calendar.min.js'
	]).pipe(gulp.dest(distPath + '/assets/plugins/bootstrap-calendar/js/'));
	
	download([
		'https://raw.githubusercontent.com/extremeFE/bootstrap-colorpalette/master/css/bootstrap-colorpalette.css'
	]).pipe(gulp.dest(distPath + '/assets/plugins/bootstrap-colorpalette/css/'));
	download([
		'https://raw.githubusercontent.com/extremeFE/bootstrap-colorpalette/master/js/bootstrap-colorpalette.js'
	]).pipe(gulp.dest(distPath + '/assets/plugins/bootstrap-colorpalette/js/'));
	
	download([
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/css/bootstrap-datetimepicker.min.css'
	]).pipe(gulp.dest(distPath + '/assets/plugins/bootstrap-datetimepicker/css/'));
	download([
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/bootstrap-datetimepicker.min.js'
	]).pipe(gulp.dest(distPath + '/assets/plugins/bootstrap-datetimepicker/js/'));
	download([
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.ar.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.az.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.bg.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.bn.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.ca.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.cs.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.da.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.de.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.ee.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.el.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.es.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.fi.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.fr.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.he.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.hr.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.hu.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.hy.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.id.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.is.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.it.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.ja.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.ka.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.ko.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.lt.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.lv.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.ms.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.nb.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.nl.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.no.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.pl.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.pt-BR.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.pt.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.ro.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.rs-latin.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.rs.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.ru.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.sk.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.sl.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.sv.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.sw.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.th.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.tr.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.ua.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.uk.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.zh-CN.js',
		'https://raw.githubusercontent.com/smalot/bootstrap-datetimepicker/master/js/locales/bootstrap-datetimepicker.zh-TW.js',
	]).pipe(gulp.dest(distPath + '/assets/plugins/bootstrap-datetimepicker/js/locales/'));
});



// 04. default-html
gulp.task('default-html', function(){
  return gulp.src(distPath + '/template_html/*.html')
    .pipe(livereload());
});

// 05. default-css
gulp.task('default-css', function(){
  return gulp.src([
			'node_modules/animate.css/animate.min.css',
			'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
			'node_modules/jquery-ui-dist/jquery-ui.min.css',
			'node_modules/pace-js/themes/black/pace-theme-flash.css',
			'scss/default/styles.scss'
		])
		.pipe(sass())
		.pipe(concat('app.min.css'))
		.pipe(minifyCSS())
		.pipe(gulp.dest(distPath + '/assets/css/default/'))
		.pipe(livereload());
});

// 06. default-css-rtl
gulp.task('default-css-rtl', function(){
	return gulp.src([
			'node_modules/animate.css/animate.min.css',
			'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
			'node_modules/jquery-ui-dist/jquery-ui.min.css',
			'node_modules/pace-js/themes/black/pace-theme-flash.css',
			'scss/default/styles.scss'
		])
		.pipe(header('$enable-rtl: true;'))
		.pipe(sass())
		.pipe(concat('app-rtl.min.css'))
		.pipe(minifyCSS())
		.pipe(gulp.dest(distPath + '/assets/css/default/'));
});

// 07. default-css-theme
gulp.task('default-css-theme', function(){
	var colorList = ['red','pink','orange','yellow','lime','green','teal','aqua','blue','purple','indigo','black'];
	
	var tasks = colorList.map(function (color) {
		return gulp.src([ 'scss/default/theme.scss' ])
			.pipe(header('$primary-color: \''+ color +'\';'))
			.pipe(sass())
			.pipe(concat(color +'.min.css'))
			.pipe(minifyCSS())
			.pipe(gulp.dest(distPath + '/assets/css/default/theme/'));
  });
	console.log('Generating the css files. Please wait...');
  return merge(tasks);
});

// 08. default-watch
gulp.task('default-watch', function () {
	livereload.listen();
  gulp.watch(distPath + '/template_html/*.html', gulp.series(gulp.parallel(['default-html'])));
  gulp.watch('scss/**/**.scss', gulp.series(gulp.parallel(['default-css', 'default-css-theme'])));
  gulp.watch('js/*.js', gulp.series(gulp.parallel(['js'])));
});

// 09. default-webserver
gulp.task('default-webserver', function() {
  gulp.src(distPath)
    .pipe(webserver({
    	host: 'localhost',
      livereload: true,
      directoryListing: false,
      open: '/template_html/',
      fallback: 'page_blank.html'
    }));
});

// 10. default
gulp.task('default', gulp.series(gulp.parallel(['fonts', 'plugins', 'js', 'default-css', 'default-css-theme', 'default-webserver', 'default-watch'])));



// 11. material-html
gulp.task('material-html', function(){
  return gulp.src(distPath + '/template_material/*.html')
    .pipe(livereload());
});

// 12. material-css
gulp.task('material-css', function(){
  return gulp.src([
			'node_modules/animate.css/animate.min.css',
			'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
			'node_modules/jquery-ui-dist/jquery-ui.min.css',
			'node_modules/pace-js/themes/black/pace-theme-flash.css',
			'scss/material/styles.scss'
		])
		.pipe(sass())
		.pipe(concat('app.min.css'))
		.pipe(minifyCSS())
		.pipe(gulp.dest(distPath + '/assets/css/material/'))
		.pipe(livereload());
});

// 13. material-css-rtl
gulp.task('material-css-rtl', function(){
	return gulp.src([
			'node_modules/animate.css/animate.min.css',
			'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
			'node_modules/jquery-ui-dist/jquery-ui.min.css',
			'node_modules/pace-js/themes/black/pace-theme-flash.css',
			'scss/material/styles.scss'
		])
		.pipe(header('$enable-rtl: true;'))
		.pipe(sass())
		.pipe(concat('app-rtl.min.css'))
		.pipe(minifyCSS())
		.pipe(gulp.dest(distPath + '/assets/css/material/'));
});

// 14. material-css-theme
gulp.task('material-css-theme', function(){
	var colorList = ['red','pink','orange','yellow','lime','green','teal','aqua','blue','purple','indigo','black'];
	
	var tasks = colorList.map(function (color) {
		return gulp.src([ 'scss/material/theme.scss' ])
			.pipe(header('$primary-color: \''+ color +'\';'))
			.pipe(sass())
			.pipe(concat(color +'.min.css'))
			.pipe(minifyCSS())
			.pipe(gulp.dest(distPath + '/assets/css/material/theme/'));
  });
	console.log('Generating the css files. Please wait...');
  return merge(tasks);
});

// 15. material-watch
gulp.task('material-watch', function () {
	livereload.listen();
  gulp.watch(distPath + '/template_material/*.html', gulp.series(gulp.parallel(['material-html'])));
  gulp.watch('scss/**/**.scss', gulp.series(gulp.parallel(['material-css', 'material-css-theme'])));
  gulp.watch('js/*.js', gulp.series(gulp.parallel(['js'])));
});

// 16. material-webserver
gulp.task('material-webserver', function() {
  gulp.src(distPath)
    .pipe(webserver({
    	host: 'localhost',
      livereload: true,
      directoryListing: false,
      open: '/template_material/',
      fallback: 'page_blank.html'
    }));
});

// 17. material
gulp.task('material', gulp.series(gulp.parallel(['fonts', 'plugins', 'js', 'material-css', 'material-css-theme', 'material-webserver', 'material-watch'])));



// 18. apple-html
gulp.task('apple-html', function(){
  return gulp.src(distPath + '/template_apple/*.html')
    .pipe(livereload());
});

// 19. apple-css
gulp.task('apple-css', function(){
  return gulp.src([
			'node_modules/animate.css/animate.min.css',
			'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
			'node_modules/jquery-ui-dist/jquery-ui.min.css',
			'node_modules/pace-js/themes/black/pace-theme-flash.css',
			'scss/apple/styles.scss'
		])
		.pipe(sass())
		.pipe(concat('app.min.css'))
		.pipe(minifyCSS())
		.pipe(gulp.dest(distPath + '/assets/css/apple/'))
		.pipe(livereload());
});

// 20. apple-css-rtl
gulp.task('apple-css-rtl', function(){
	return gulp.src([
			'node_modules/animate.css/animate.min.css',
			'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
			'node_modules/jquery-ui-dist/jquery-ui.min.css',
			'node_modules/pace-js/themes/black/pace-theme-flash.css',
			'scss/apple/styles.scss'
		])
		.pipe(header('$enable-rtl: true;'))
		.pipe(sass())
		.pipe(concat('app-rtl.min.css'))
		.pipe(minifyCSS())
		.pipe(gulp.dest(distPath + '/assets/css/apple/'));
});

// 21. apple-css-theme
gulp.task('apple-css-theme', function(){
	var colorList = ['red','pink','orange','yellow','lime','green','teal','aqua','blue','purple','indigo','black'];
	
	var tasks = colorList.map(function (color) {
		return gulp.src([ 'scss/apple/theme.scss' ])
			.pipe(header('$primary-color: \''+ color +'\';'))
			.pipe(sass())
			.pipe(concat(color +'.min.css'))
			.pipe(minifyCSS())
			.pipe(gulp.dest(distPath + '/assets/css/apple/theme/'));
  });
	console.log('Generating the css files. Please wait...');
  return merge(tasks);
});

// 22. apple-watch
gulp.task('apple-watch', function () {
	livereload.listen();
  gulp.watch(distPath + '/template_apple/*.html', gulp.series(gulp.parallel(['apple-html'])));
  gulp.watch('scss/**/**.scss', gulp.series(gulp.parallel(['apple-css', 'apple-css-theme'])));
  gulp.watch('js/*.js', gulp.series(gulp.parallel(['js'])));
});

// 23. apple-webserver
gulp.task('apple-webserver', function() {
  gulp.src(distPath)
    .pipe(webserver({
    	host: 'localhost',
      livereload: true,
      directoryListing: false,
      open: '/template_apple/',
      fallback: 'page_blank.html'
    }));
});

// 24. apple
gulp.task('apple', gulp.series(gulp.parallel(['fonts', 'plugins', 'js', 'apple-css', 'apple-css-theme', 'apple-webserver', 'apple-watch'])));



// 25. transparent-html
gulp.task('transparent-html', function(){
  return gulp.src(distPath + '/template_transparent/*.html')
    .pipe(livereload());
});

// 26. transparent-css
gulp.task('transparent-css', function(){
  return gulp.src([
			'node_modules/animate.css/animate.min.css',
			'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
			'node_modules/jquery-ui-dist/jquery-ui.min.css',
			'node_modules/pace-js/themes/black/pace-theme-flash.css',
			'scss/transparent/styles.scss'
		])
		.pipe(sass())
		.pipe(concat('app.min.css'))
		.pipe(minifyCSS())
		.pipe(gulp.dest(distPath + '/assets/css/transparent/'))
		.pipe(livereload());
});

// 27. transparent-css-rtl
gulp.task('transparent-css-rtl', function(){
	return gulp.src([
			'node_modules/animate.css/animate.min.css',
			'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
			'node_modules/jquery-ui-dist/jquery-ui.min.css',
			'node_modules/pace-js/themes/black/pace-theme-flash.css',
			'scss/transparent/styles.scss'
		])
		.pipe(header('$enable-rtl: true;'))
		.pipe(sass())
		.pipe(concat('app-rtl.min.css'))
		.pipe(minifyCSS())
		.pipe(gulp.dest(distPath + '/assets/css/transparent/'));
});

// 28. transparent-css-theme
gulp.task('transparent-css-theme', function(){
	var colorList = ['red','pink','orange','yellow','lime','green','teal','aqua','blue','purple','indigo','black'];
	
	var tasks = colorList.map(function (color) {
		return gulp.src([ 'scss/transparent/theme.scss' ])
			.pipe(header('$primary-color: \''+ color +'\';'))
			.pipe(sass())
			.pipe(concat(color +'.min.css'))
			.pipe(minifyCSS())
			.pipe(gulp.dest(distPath + '/assets/css/transparent/theme/'));
  });
	console.log('Generating the css files. Please wait...');
  return merge(tasks);
});

// 29. transparent-watch
gulp.task('transparent-watch', function () {
	livereload.listen();
  gulp.watch(distPath + '/template_transparent/*.html', gulp.series(gulp.parallel(['transparent-html'])));
  gulp.watch('scss/**/**.scss', gulp.series(gulp.parallel(['transparent-css', 'transparent-css-theme'])));
  gulp.watch('js/*.js', gulp.series(gulp.parallel(['js'])));
});

// 30. transparent-webserver
gulp.task('transparent-webserver', function() {
  gulp.src(distPath)
    .pipe(webserver({
    	host: 'localhost',
      livereload: true,
      directoryListing: false,
      open: '/template_transparent/',
      fallback: 'page_blank.html'
    }));
});

// 31. transparent
gulp.task('transparent', gulp.series(gulp.parallel(['fonts', 'plugins', 'js', 'transparent-css', 'transparent-css-theme', 'transparent-webserver', 'transparent-watch'])));



// 32. facebook-html
gulp.task('facebook-html', function(){
  return gulp.src(distPath + '/template_facebook/*.html')
    .pipe(livereload());
});

// 33. facebook-css
gulp.task('facebook-css', function(){
  return gulp.src([
			'node_modules/animate.css/animate.min.css',
			'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
			'node_modules/jquery-ui-dist/jquery-ui.min.css',
			'node_modules/pace-js/themes/black/pace-theme-flash.css',
			'scss/facebook/styles.scss'
		])
		.pipe(sass())
		.pipe(concat('app.min.css'))
		.pipe(minifyCSS())
		.pipe(gulp.dest(distPath + '/assets/css/facebook/'))
		.pipe(livereload());
});

// 34. facebook-css-rtl
gulp.task('facebook-css-rtl', function(){
	return gulp.src([
			'node_modules/animate.css/animate.min.css',
			'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
			'node_modules/jquery-ui-dist/jquery-ui.min.css',
			'node_modules/pace-js/themes/black/pace-theme-flash.css',
			'scss/facebook/styles.scss'
		])
		.pipe(header('$enable-rtl: true;'))
		.pipe(sass())
		.pipe(concat('app-rtl.min.css'))
		.pipe(minifyCSS())
		.pipe(gulp.dest(distPath + '/assets/css/facebook/'));
});

// 35. facebook-css-theme
gulp.task('facebook-css-theme', function(){
	var colorList = ['red','pink','orange','yellow','lime','green','teal','aqua','blue','purple','indigo','black'];
	
	var tasks = colorList.map(function (color) {
		return gulp.src([ 'scss/facebook/theme.scss' ])
			.pipe(header('$primary-color: \''+ color +'\';'))
			.pipe(sass())
			.pipe(concat(color +'.min.css'))
			.pipe(minifyCSS())
			.pipe(gulp.dest(distPath + '/assets/css/facebook/theme/'));
  });
	console.log('Generating the css files. Please wait...');
  return merge(tasks);
});

// 36. facebook-watch
gulp.task('facebook-watch', function () {
	livereload.listen();
  gulp.watch(distPath + '/template_facebook/*.html', gulp.series(gulp.parallel(['facebook-html'])));
  gulp.watch('scss/**/**.scss', gulp.series(gulp.parallel(['facebook-css', 'facebook-css-theme'])));
  gulp.watch('js/*.js', gulp.series(gulp.parallel(['js'])));
});

// 37. facebook-webserver
gulp.task('facebook-webserver', function() {
  gulp.src(distPath)
    .pipe(webserver({
    	host: 'localhost',
      livereload: true,
      directoryListing: false,
      open: '/template_facebook/',
      fallback: 'page_blank.html'
    }));
});

// 38. facebook
gulp.task('facebook', gulp.series(gulp.parallel(['fonts', 'plugins', 'js', 'facebook-css', 'facebook-css-theme', 'facebook-webserver', 'facebook-watch'])));
