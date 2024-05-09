
const { src, dest, watch , series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));



function css( callback) {
    src("src/scss/**/*.scss")//Identificar el archivo de SASS
    .pipe( sass())          //Compilarlo
    .pipe(dest("build/css"));//Almacenar en el disco duro
    
    callback(); //Avisa a gulp cuando llegamos al fina;
}

function dev(callback){
    watch("src/scss/**/*.scss", css);
                
    callback();
}



exports.css = css;
exports.dev = dev;
// exports.watchArchivos = watchArchivos;
// exports.default = parallel(dev, javascript,  imagenes, versionWebp,  watchArchivos ); 