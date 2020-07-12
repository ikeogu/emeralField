

<template>
  
  
  <div id="postsrec" class="mt-5">

    <div class="row mt-5">
        <h6>Session:{{term.session}}</h6>
      <div class="col-lg-12 text-right" style="margin-bottom: 20px;">
        <a href="#"
           data-target="#exampleModal"
           data-toggle="modal"
           class="btn btn-success">{{term.name}}</a>
      </div>
    </div>

    <div class="row justify-content-center">
      <div v-bind:class="{ succmsg: succmsg }">
        <div class="col-md-12 col-lg-12">
          <div class="alert alert-success cusmsg">{{ actionmsg }}</div>
        </div>
      </div>
      <div class="col-md-12">
        <!-- Button trigger modal -->

       


        <div class="card">
          <div class="card-header">Class List</div>
          <div class="card-body">

            <table class="table table-striped table-bordered" style="width:100%">
              <thead>
                
                  <th>Class Name</th>
                  <th>Class Description</th>
                  <th>Class Max No of Students</th>
                  <th>Class Level</th>
                  <th>Students in this Class</th>
                  
                
              </thead>
              <tbody>
                <tr v-for="las in laravelData" :key="las.id">
                  <td>{{ las.name }}</td>
                  <td>{{ las.description }}</td>
                  <td>{{ las.no_of_students }}</td>
                  <td>{{ las.status }}</td>
                  <td>
                    <a :href="'http://127.0.0.1:8000/api/terms_class/'+las.id+'/term/'+term.id" class="btn btn-info text-white ">view  Students</a>
                  </td>
                  <!-- link to student in a class -->
                  
                </tr>
              </tbody>
            
            </table>
            
          </div>
        </div>

      </div>
    </div>
  </div>

</template>

<script>

  export default {
    data() {
      return {
       
        laravelData:{},
        term:{},
        id: '',
        succmsg: true,
        showmodal: false,
        pagenumber: 1,
        actionmsg: ''
      }
    },
    methods: {
      
        
      
      
    
    },
    props:['term_1','sess'],
    mounted() {
      
       this.laravelData = this.term_1
       
       this.term = this.sess
       
       
     
    }
  }

</script>

<style scoped>

  .succmsg {
    display: none;
  }
  .showmodal {
    display: none !important;
    opacity: 0;
  }

</style>
