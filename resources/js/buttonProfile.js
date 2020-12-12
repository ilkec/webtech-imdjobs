//buttonProfile
if(window.location.pathname.indexOf('/user/profile/') >= 0) {  //important to not give errors on pages with other vueJS features
    var buttonProfile = new Vue({
        el: '#buttonProfile',
        data: {
            button: user
        }
    })
}        