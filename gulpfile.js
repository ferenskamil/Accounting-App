const { src, dest, parallel, series, watch } = require('gulp');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();
const php = require('gulp-connect-php');
const reload = browserSync.reload;
const clean = require('gulp-clean');

const kit = require('gulp-kit');

const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss');
const cssnano = require('cssnano');

const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

const imagemin = require('gulp-imagemin');

const paths = {
	// html: './src/html/**/*.kit',
	html: './src/php/**/*.kit',
	sass: './src/scss/**/*.scss',
	js: './src/js/**/*.js',
	img: './src/img/**/*',
	dist: './dist',
	sassDest: './dist/css',
	jsDest: './dist/js',
	imgDest: './dist/img',
};

function handleKits(done) {
	src(paths.html)
		.pipe(kit())
		// This below will be using for change files enxtension to ".php"
		.pipe(
			rename(function (path) {
				// Updates the object in-place  // path.dirname += '/ciao'; // path.basename += '-goodbye';
				path.extname = '.php';
			})
		)
		.pipe(dest('./'));
	done();
}

function sassCompiler(done) {
	src(paths.sass)
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(postcss([autoprefixer()]))
		// .pipe(dest('./dist/css'))
		.pipe(postcss([cssnano()]))
		.pipe(rename({ suffix: '.min' }))
		.pipe(sourcemaps.write())
		.pipe(dest(paths.sassDest));
	done();
}

function javaScript(done) {
	src(paths.js)
		.pipe(sourcemaps.init())
		// .pipe(babel({ presets: ['@babel/env'] }))
		.pipe(uglify())
		.pipe(rename({ suffix: '.min' }))
		.pipe(sourcemaps.write())
		.pipe(dest(paths.jsDest));
	done();
}

function convertImages(done) {
	src(paths.img).pipe(imagemin()).pipe(dest(paths.imgDest));
	done();
}

function startBrowserSync(done) {
	browserSync.init({
		server: {
			baseDir: './',
		},
	});
	done();
}

function watchForChanges(done) {
	// watch('./*.html').on('change', reload);
	watch('./*.php').on('change', reload);
	watch(
		[paths.html, paths.sass, paths.js],
		parallel(handleKits, sassCompiler, javaScript)
	).on('change', reload);
	watch(paths.img, convertImages).on('change', reload);

	done();
}

function watchPhp(done) {
	watch(['./*.html', './*.php']).on('change', browserSync.reload);
	done();
}

function sync(done) {
	php.server({
		base: './',
		port: 3000,
		keepalive: true,
		// custom PHP locations
		bin: '../../php/php.exe',
		ini: '../../php/php.ini',
	});
	browserSync.init({
		proxy: 'localhost:3000',
		baseDir: './',
		notify: false,
	});
	done();
}

function cleanStuff(done) {
	src(paths.dist, { read: false }).pipe(clean());
	done();
}

const mainFunctions = parallel(
	handleKits,
	sassCompiler,
	javaScript,
	convertImages
);
exports.default = series(
	mainFunctions,
	// startBrowserSync,
	watchForChanges,
	watchPhp,
	sync
);
exports.cleanStuff = cleanStuff;
exports.handleKits = handleKits;
