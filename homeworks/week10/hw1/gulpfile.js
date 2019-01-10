const gulp = require('gulp');
const del = require('del');

const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

const stylus = require('gulp-stylus');
const autoprefixer = require('gulp-autoprefixer');
const cleanCss = require('gulp-clean-css');

const paths = {
	src: './src',
	bulid: './bulid'
}

function clean(cb){
	del([paths.bulid]);
	cb();
}

function bulidJs(cb){
    gulp.src(paths.src.concat('/js/*.js'))
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(uglify())
        .pipe(gulp.dest(paths.bulid.concat('/js/')));
    cb();
};

function bulidCss(cb){
	gulp.src(paths.src.concat('/css/*.styl'))
		.pipe(stylus())
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
            cascade: false
		}))
		.pipe(cleanCss())
		.pipe(gulp.dest(paths.bulid.concat('/css/')))
	cb();
}


const bulid = gulp.series(clean, bulidJs, bulidCss);

gulp.task('default', bulid);