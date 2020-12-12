//buttonProfile
if(window.location.pathname == `/user/profile/${user}`) {  //important to not give errors on pages with other vueJS features
    console.log('test')
    var buttonProfile = new Vue({
        el: '#buttonProfile',
        data: {
            button: user
        }
    })
}        