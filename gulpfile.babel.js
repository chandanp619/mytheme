import gulp from 'gulp';
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCSS from 'gulp-clean-css';
import gulpif from 'gulp-if';
import sourcemaps from 'gulp-sourcemaps';
import imagemin from 'gulp-imagemin';

sass.compiler = require('node-sass');

const PRODUCTION = yargs.argv.prod;


const paths = {
    styles: {
        src:['resources/styles/**/*.scss'],
        dest:'dest/assets/css'
    },
    images: {
        src: 'resources/images/**/*.{jpg,jpeg,png,gif,svg}',
        dest: 'dest/assets/images'
    }
};

export const styles  = () => {
return gulp.src(paths.styles.src)
    .pipe(sass().on('error',sass.logError))
    .pipe(gulpif(PRODUCTION, cleanCSS({compatibility:'ie8'})))
    .pipe(gulp.dest(paths.styles.dest));
}

export const watch  = () => {
    gulp.watch(paths.styles.src,styles);
}

export const images = () =>{
    return gulp.src(paths.images)
        .pipe(gulpif(PRODUCTION,imagemin()))
        .pipe(gulp.dest(paths.images.dest));
}
