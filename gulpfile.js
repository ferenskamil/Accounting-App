const { src, dest, parallel, series, watch } = require('gulp');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const clean = require('gulp-clean');

const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss');
const cssnano = require('cssnano');

const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

const imagemin = require('gulp-imagemin');

const paths = {
	sass: './src/scss/**/*.scss',
	js: './src/js/**/*.js',
	img: './src/app_img/**/*',
	dist: './public',
	sassDest: './assets/css',
	jsDest: './assets/js',
	imgDest: './assets/app_img',
};

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
		.pipe(babel({ presets: ['@babel/env'] }))
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

function watchForChanges(done) {
	watch([paths.sass, paths.js], parallel(sassCompiler, javaScript)).on(
		'change',
		reload
	);
	watch(paths.img, convertImages).on('change', reload);

	done();
}

function cleanStuff(done) {
	src(paths.dist, { read: false }).pipe(clean());
	done();
}

const mainFunctions = parallel(
	sassCompiler,
	javaScript,
	convertImages
);
exports.default = series(
	mainFunctions,
	watchForChanges,
);
exports.cleanStuff = cleanStuff;
