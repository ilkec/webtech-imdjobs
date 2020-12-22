document.querySelector('#btn-searchInternship').addEventListener('click', (e) => {
    let type = document.querySelector('#inputTypeSelect').value
    console.log(type)
    let city = document.querySelector('#city').value
    console.log(city)
    let csfr = document.querySelector('input').value
    console.log(csfr)

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
           console.log(result)
        })
        .catch((error) => {
        console.error('Error:', error);
        });

})

if(window.location.pathname == '/') { //important to not give errors on pages with other vueJS features
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
    
    //field for checking if they are php enabled
    let nearbyField = document.querySelector('#internships')
    let otherField = document.querySelector('#others')

    if(nearbyField != null) { //check if field are enabled with php 
        new Vue({
            el: "#internships",
            data: {
                internships: nearbyInternships,       
            }
        })
    }
    
    if(otherField != null) { //check if field are enabled with php 
        new Vue({
            el:"#others",
            data: {
                internships: otherInternships
            }
        })
    }
}