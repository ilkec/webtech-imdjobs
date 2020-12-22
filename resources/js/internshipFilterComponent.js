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


var nearby = new Vue({
    el: "#internships",
    data: {
        test: "test",
        internships: nearbyInternships    
    }
})





let nearbyInternships;
let otherInternships;
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
                nearbyInternships = result.nearbyInternshipsJSON
                otherInternships = result.otherInternshipsJSON
    
                document.querySelector('#internships').innerHTML = `<internship v-for="internship in internships" v-bind:companies_id="internship.companies_id" v-bind:id="internship.id" v-bind:title="internship.title" v-bind:description="internship.description" v-bind:tasks="internship.tasks" v-bind:postal_code="internship.postal_code" v-bind:city="internship.city" v-bind:name="internship.companies.name">
                </internship>`;
                
                nearby.internships = nearbyInternships;
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
})



