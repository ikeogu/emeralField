<template>

  <div id="postsrec" class="mt-5">

    <div class="row mt-5">
      <div class="col-lg-12 text-right" style="margin-bottom: 20px;">
        <a href="#"
           data-target="#exampleModal"
           data-toggle="modal"
           class="btn btn-success">Add Student</a>
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

        <div class="modal fade"
             id="exampleModal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             v-bind:class="{ showmodal:showmodal }">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
             
              <div class="modal-body">
                <form method="post" name="addstudent" id="addstudent" action="#" @submit.prevent="addStudent">
                  <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" v-model="student.name" />
                  </div>
                  <div class="form-group">
                    <label for="father_name">Surname</label>
                    <input type="text" name="surname" id="father_name" class="form-control" placeholder="Father Name" v-model="student.surname"
                    />
                  </div>
                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender" v-model="student.gender">
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                      <option value="3">Other</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="roll_no">Date of Birth</label>
                    <input type="date" name="date" id="roll_no" class="form-control" placeholder="Roll Number" v-model="student.dob" />

                  </div>
                  <!-- <div class="form-group">
                    <label for="roll_no">Roll#</label>
                    <input type="text" name="roll_no" id="roll_no" class="form-control" placeholder="Roll Number" v-model="student.roll_no" />
                  </div> -->
                  <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact" class="form-control" placeholder="Contact" v-model="student.contact" />
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" v-model="student.address" />
                  </div>

                  <div class="form-group">
                    <label for="address">Start Class</label>
                    <select class="form-control" name="s_class" v-model="student.s_class"  placeholder="Choose Class">
                      
                      <option v-for="classes in laravelClassData.data" v-bind:value="classes.id" :key="classes.id">
                          {{classes.name}}
                      </option>
                    </select>
                </div>
                <div class="form-group">
                        <label for="address">Academic Session</label>
                        <select class="form-control" name="term_id" v-model="student.term_id"  >
                          
                          <option v-for="term in laravelTerm.data" v-bind:key="term.id" >
                              {{term.name}} ({{term.session}})
                          </option>
                        </select>
                      </div>
                <div class="form-group">
                  <label for="email">Parent Email</label>
                  <input type="text" name="p_email" id="email" class="form-control" placeholder="email@gmail.com" v-model="student.p_email" />
                </div>
                <div class="form-group">
                  <label for="email">Special case? (Yes/NO)</label>
                  <input type="text" name="identification_mark" id="email" class="form-control" placeholder="" v-model="student.identification_mark" />
                </div> 

                  <div class="form-group text-right">
                    <button class="btn btn-success">Submit</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>

        <div class="modal fade"
             id="exampleModal1"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             v-bind:class="{ showmodal:showmodal }">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
              </div>
              <div class="modal-body">
                <form method="post" name="updatestudent" id="updatestudent" action="#" @submit.prevent="updateStudent">
                  <div class="form-group">
                    <label for="name">Student Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" v-model="student.name" />
                  </div>
                  <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text"
                           name="surname"
                           id="father_name"
                           class="form-control"
                           placeholder="Surname"
                           v-model="student.surname" />
                  </div>
                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender" v-model="student.gender">
                          <option value="1">Male</option>
                          <option value="2">Female</option>
                          <option value="3">Other</option>
                        </select>
                  </div>
                   <div class="form-group">
                    <label for="roll_no">Date of Birth</label>
                    <input type="text" name="dob" id="roll_no" class="form-control" placeholder="Roll Number" v-model="student.dob" />
                  </div>
                  <div class="form-group">
                    <label for="roll_no">Roll#</label>
                    <input type="text" name="roll_no" id="roll_no" class="form-control" placeholder="Roll Number" v-model="student.roll_no" />
                  </div>
                  <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact" class="form-control" placeholder="Contact" v-model="student.contact" />
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" v-model="student.address" />
                  </div>
                      <div class="form-group">
                        <label for="address">Choose a Class</label>
                        <select class="form-control" name="s_class" v-model="student.s_class"  placeholder="Choose Class">
                          
                          <option v-for="classes in laravelClassData.data" v-bind:key="classes.id" >
                              {{classes.name}}
                          </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="address">Choose Session</label>
                        <select class="form-control" name="term_id" v-model="student.term_id"  placeholder="Choose Class">
                          
                          <option v-for="term in laravelTerm.data" v-bind:key="term.id" >
                              {{term.name}}{{term.session}}
                          </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="email">Parent Email</label>
                        <input type="text" name="p_email" id="email" class="form-control"  v-model="student.p_email" />
                      </div> 
                     <div class="form-group">
                      <label for="email">Special case? (Yes/NO)</label>
                      <input type="text" name="identification_mark" id="email" class="form-control" placeholder="" v-model="student.identification_mark" />
                    </div> 
                  <div class="form-group text-right">
                    <button class="btn btn-success">Submit</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <p>Are you sure want to delete the record? </p>
                </div>
                <div class="form-group text-center">
                  <button class="btn btn-success" v-on:click="hideModal()">Cancel</button>
                </div>
                <div class="form-group text-center">
                  <button class="btn btn-success" v-on:click="deleteStudent()">Ok</button>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success"> {{(laravelData.data).length}} Students Record</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                
                  <th>Roll#</th>
                  <th>First Name</th>
                  <th>Surame</th>
                  <th>Email</th>
                  <th>Parent Email</th>
                  <th>Gender</th>
                  <th>Contact</th>
                  <th colspan="2">Action</th>
                
              </thead>
              <tbody>
                <tr v-for="student in laravelData.data" :key="student.id">
                  <th scope="row">{{ student.roll_no }}</th>
                  <td>{{ student.name }}</td>
                  <td>{{ student.surname.slice(0,50) + "....." }}</td>
                  <td>{{ student.email }}</td>
                  <td>{{ student.p_email }}</td>
                  <td>{{ student.gender }}</td>
                  <td>{{ student.contact }}</td>
                  <td><a href="#"
                       v-on:click="editStudent(student.id)"
                       data-target="#exampleModal1"
                       data-toggle="modal"
                       v-bind:title="student.name" class="btn btn-info text-white ">Edit</a></td>
                       
                  <td><a href="#" data-target="#exampleModal2" v-on:click="deleteId(student.id)" data-toggle="modal" v-bind:id="id" class="btn btn-danger text-white">Delete</a></td>
                   <!-- <td> 
                    <a href="{{route('student.subjects',[sub.id])}}"> Assign Subject</a>
                  </td> -->
                </tr>
              </tbody>
              
            </table>
            <pagination :data="laravelData" :limit="2" @pagination-change-page="studentLists">
              <span slot="prev-nav">&lt; Previous</span>
              <span slot="next-nav">Next &gt;</span>
            </pagination>
          </div>
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
        student: {
          student_id:'',
          name: '',
          surname: '',
          roll_no: '',
          gender: '',
          contact: '',
          address: '',
          p_email:'',
          s_class:'',
          term_id:'',
          dob:'',
          identification_mark:'',
        },
        laravelData: {},
        laravelClassData:{},
        laravelTerm:{},
        id: '',
        succmsg: true,
        showmodal: false,
        pagenumber: 1,
        actionmsg: ''
      }
    },
    ready: function() {
      this.fetchClasses();
      this.fetchTerms();
      },
      
        
    methods: {

      fetchClasses() {
        this.$http.get('http://127.0.0.1:8000/api/schclasses').then(response => {
          //this.posts = response.data.data;
          this.laravelClassData = response.data
          
        })
      },
        fetchTerms() {
        this.$http.get('http://127.0.0.1:8000/api/terms').then(responses => {
          //this.posts = response.data.data;
          this.laravelTerm = responses.data
          
          
        })   
        
      },
      
      studentLists(page) {
        if (typeof page === 'undefined') {
          page = 1
        }
        this.$http.get('http://127.0.0.1:8000/api/students?page=' + page).then(response => {
          //this.posts = response.data.data;
          this.laravelData = response.data
          this.pagenumber = page
        })
      },
      addStudent() {
        this.$http
          .post('http://127.0.0.1:8000/api/students', {
            name: this.student.name,
            surname: this.student.surname,
            gender: this.student.gender,
            contact: this.student.contact,
            roll_no: this.student.roll_no,
            address: this.student.address,
            p_email:this.student.p_email,
            s_class:this.student.s_class,
            term_id:this.student.term_id,
            identification_mark:this.student.identification_mark,
            dob:this.student.dob,

          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.student.name = ''
            this.student.surname = ''
            this.student.gender = ''
            this.student.roll_no = ''
            this.student.contact = ''
            this.student.address = ''
            this.student.p_email = ''
            this.student.s_class= ''
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Student inserted successfully'
            
            $('#exampleModal').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            this.studentLists(this.pagenumber)
          })
      },
      editStudent(studentid) {
        this.$http.get('http://127.0.0.1:8000/api/students/' + studentid).then(data => {
          
          this.student.name = data.data.data.name
          this.student.surname = data.data.data.surname
          this.student.p_email = data.data.data.p_email
          this.student.gender = data.data.data.gender
          this.student.roll_no = data.data.data.roll_no
          this.student.contact = data.data.data.contact
          this.student.address = data.data.data.address
          this.student.s_class = data.data.data.s_class
          this.student.term_id = data.data.data.term_id
          this.id = studentid
        })
      },
      updateStudent() {
        this.$http
          .patch('http://127.0.0.1:8000/api/students/' + this.id, {
            student_id:this.id,
            name: this.student.name,
            surname: this.student.surname,
            gender: this.student.gender,
            contact: this.student.contact,
            roll_no: this.student.roll_no,
            address: this.student.address,
            s_class:this.student.s_class ,
            term_id:this.student.term_id 
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.student.name = ''
            this.student.father_name = ''
            this.student.gender = ''
            this.student.roll_no = ''
            this.student.contact = ''
            this.student.address = ''
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Data updated successfully'
            $('#exampleModal1').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            this.studentLists(this.pagenumber)
          })
      },
      deleteId(studentid) {
        this.id = studentid
      },
      deleteStudent() {
        this.$http.delete('http://127.0.0.1:8000/api/students/' + this.id).then(data => {
          this.succmsg = false
          var self = this
          setTimeout(function() {
            self.succmsg = true
          }, 3000)

          this.actionmsg = 'Data deleted successfully'
          this.studentLists(this.pagenumber)
          $('#exampleModal2').modal('hide')
          $('body')
            .removeClass()
            .removeAttr('style')
          $('.modal-backdrop').remove()
        })
      },
      hideModal() {
        $('#exampleModal2').modal('hide')
        $('body')
          .removeClass()
          .removeAttr('style')
        $('.modal-backdrop').remove()
      }
    },
    mounted() {
      this.fetchClasses();
      this.studentLists()
      this.fetchTerms()
      
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
