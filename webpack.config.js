var Encore = require('@symfony/webpack-encore');

    Encore
        .setOutputPath('web/build/')  
        .setPublicPath('/web')  
        .addEntry('app', './assets/js/app.js')  
        .addEntry('style', './assets/scss/main.scss')
	.autoProvidejQuery()
        .cleanupOutputBeforeBuild()  
        .enableBuildNotifications()
        .enableSassLoader();

    module.exports = Encore.getWebpackConfig();
