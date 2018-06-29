var Encore = require('@symfony/webpack-encore');

    Encore
        .setOutputPath('web/build/')  
        .setPublicPath('/web')  
        .addEntry('app', './assets/js/app.js')  
        .addEntry('style', './assets/scss/main.scss')
        .addEntry('logo', './assets/css/style.css')
        .addEntry('Helvetica', './assets/fonts/Helvetica/HelveticaInseratLTStd-Roman.otf')
        .cleanupOutputBeforeBuild()  
        .enableBuildNotifications()
        .enableSassLoader();

    module.exports = Encore.getWebpackConfig();
