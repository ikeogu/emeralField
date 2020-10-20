<template>

  <div id="postsrec" class="mt-5">

    <div class="row mt-3 jumbotron" style="margin-bottom: 20px;">
      
        <div class="col-4">  
            <h3>Welcome!</h3>
        </div>
        <div class="col-4"> 
             <h3>{{logged_in.surname}} {{logged_in.name}}</h3>
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

        <!-- Modal -->



        <div class="card shadow mb-4 ">
          <div class="card-header py-3 row">
            <div class=" col-6">
            <h6 class="m-0 font-weight-bold text-primary">Biodata</h6>
            </div>
            <div class=" col-6">
              <h6 class="m-0 font-weight-bold text-primary " >Class</h6>
            </div>
          </div> 
                <div class="card-body">
                <!-- Nested Row within Card Body -->
                    <div class="row p-5 mt-3">
                      <div class="col-6">
                        <form  class="user" method="post" name="updatestudent" id="updatestudent" action="#" @submit.prevent="updateStudent">
                            <div class="form-group row ">
                                <div class="col-4">
                                    <label for="name">Surname</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="surname" id="name" class="form-control form-control-user" placeholder="Name" v-model="logged_in.surname">
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-4">
                                    <label for="name">First Name</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="name" id="name" class="form-control form-control-user" placeholder="Name" v-model="logged_in.name">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                               <div class="col-4">
                                    <label for="name">Gender</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="gender" id="name" class="form-control form-control-user" placeholder="Name" v-model="logged_in.gender">
                                </div>
                            </div>

                            <div class="form-group row">
                               <div class="col-4">
                                    <label for="name">DOB</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="dob" id="name" class="form-control form-control-user" placeholder="Name" v-model="logged_in.dob">
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="name">Parent Email</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="p_email" id="name" class="form-control form-control-user" placeholder="Name" v-model="logged_in.p_email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="name">Contact</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="contact" id="name" class="form-control form-control-user" placeholder="Name" v-model="logged_in.contact">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="name">Address</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="address" id="name" class="form-control form-control-user" placeholder="Name" v-model="logged_in.address">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </form>
                      </div>
                      <div class="col-1 vertical">
                      </div>
                      <div class="col-5">

                        <div v-for="cla in myClasses"  :key="cla.id" class="card" style="width: 12rem; height: 12rem;" >
                          <div class="card-body">
                            <h5 class="card-title">{{cla.name}}</h5>
                            <p class="card-text">{{cla.description}}</p>
                            <a href="#" class="btn btn-success" v-on:click="ClassId(cla.id)"  v-bind:id="cla.id" data-toggle="modal" data-target="#exampleModalCenter">view</a>
                          </div>
                        </div>

                      </div>
                    </div>
                </div>
            
              </div>
        </div>
      </div>
      <!-- Button trigger modal -->
        

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Choose Term</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body ">
                <div class="row ">
                 <div v-for="term in terms"  :key="term.id" class="card col-4 p-3 " style="width: 15rem; height: 10rem;" >
                    <div class="card-body">
                      <h5 class="card-title">{{term.name}}</h5>
                      <p class="card-text">{{term.session}}</p>
                      <a :href="'https://emerald-field-school.herokuapp.com/api/my_subjects/'+logged_in.id+'/class/'+class_id+'/term/'+term.id" class="btn btn-success"  >view</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                
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
        logged_in:{
          surname:'',
          name:'',
          dob:'',
          contact:'',
          address:'',
          p_email:'',

        },
        
        class_id:'',
        terms:{},
        myClasses: {},
        succmsg: true,
        showmodal: false,
        pagenumber: 1,
        actionmsg: ''
      }
    },
    ready: function() {
      
      },
      
        
    methods: {

      fetchMyClass() {
        this.$http.get('https://emerald-field-school.herokuapp.com/api/myclass/' +this.logged_in.id ).then(response => {
          this.myClasses = response.data.data
        })
      },
     
      updateStudent() {
        this.$http
          .patch('https://emerald-field-school.herokuapp.com/api/students/' + this.logged_in.id, {

            student_id:this.logged_in.id,
            name: this.logged_in.name,
            surname: this.logged_in.surname,
            dob: this.logged_in.dob,
            contact: this.logged_in.contact,
            address: this.logged_in.address,
            
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
                     
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Student updated successfully'
            $('#exampleModal1').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            
          })
      },
      
      ClassId(class_id){
        this.class_id = class_id,
        this.$http.get('https://emerald-field-school.herokuapp.com/api/s5class_term/' + class_id ).then(response => {
          this.terms = response.data.data
        })
      },
      
    },
    
    props:['stud_login'],
    mounted() {
      this.logged_in = this.stud_login;
      
      this.fetchMyClass();
      
     
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
