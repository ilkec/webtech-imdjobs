if(window.location.pathname == '/') { //important to not give errors on pages with other js features
    
}


Vue.component('internship', {
    template: `<div>
    <a :href="'/companies/' + companies_id + '/internships/' + id"><h2>{{ title }}</h2></a>
    <div class="flexed">
        <P>Description:</p>
        <p class="flexed__item">{{ description }}</p>
    </div>
    <div class="flexed">
        <P>Tasks:</p>
        <p class="flexed__item">{{ tasks }}</p>
    </div>
    <section class="row">
        <div>
            <a :href="'/companies/' + companies_id">{{ name }}</a>
            <p>{{ postal_code }}, {{ city }}</p>
        </div>
    </section>  
    <hr>
    </div>`,
    props: [`companies_id`, `id`, `title`, `description`, `tasks`, `postal_code`, `city`, `name`, `picture`]
});


let nearbyInternships;
let otherInternships;

var nearby = new Vue({
    el: "#internships",
    data: {
        internships: nearbyInternships    
    }
})

var others = new Vue({
    el: "#others",
    data: {
        internships: otherInternships    
    }
})





document.querySelector('#btn-searchInternship').addEventListener('click', (e) => {
    let type = document.querySelector('#inputTypeSelect').value
    let city = document.querySelector('#city').value
    let csfr = document.querySelector('input').value

    if (document.querySelector('.alert') == null && city === "" || type === "" || csfr === "") {
        console.log(document.querySelector('.alert'))
        let title = document.querySelector('.form__title')
        let div = `<div class="alert alert-danger" role="alert">Please fill in all fields</div>`
        title.insertAdjacentHTML('afterEnd', div)
    }else if (document.querySelector('.alert') != null && city === "" || type === "" === csfr != "") {
        //if some fields are still not filled in and already displaying error -> do nothing
    } else {

        let formData = new FormData()
        formData.append('type', type)
        formData.append('city', city)
        formData.append('csfr', csfr)

        fetch('/ajaxSearchInternshipCall', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            })
            .then((response) => response.json())
            .then((result) => {
                if (document.querySelector('.alert') != null) {
                    document.querySelector('.alert').remove()
                }
                nearbyInternships = JSON.parse(result.nearbyInternshipsJSON)
                otherInternships = JSON.parse(result.otherInternshipsJSON)

                nearby.internships = nearbyInternships
                others.internships = otherInternships
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
})



