<template>

  <div id="postsrec" class="mt-5">

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
             id="exampleModal1"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             v-bind:class="{ showmodal:showmodal }">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Subjects</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
              </div>
              <div class="modal-body">
                <form v-if="this.unassignedSubjects.length > 0" method="post" name="assignsubjects" id="assignsubjects" action="#" @submit.prevent="assignSubject(student_id, subject_id)">

                  <div class="form-group">
                    <label for="gender">Assigned Subjects</label>
                    <select class="form-control" name="subject" id="subject" v-model="subject_id">
                          <option v-for="subject in unassignedSubjects"  :key="subject.id" v-bind:value="subject.id">{{ subject.name }}</option>
                    </select>
                  </div>

                  <div class="form-group text-center">
                    <button class="btn btn-success">Submit</button>
                  </div>
                </form>
                <span v-else>All Subjects has been Assigned to this Student!</span>
                <br>

                <div class="card">
                  <div class="card-header">Assigned Subject</div>
                    <div class="card-body">
                      <table class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Subjects</th>
                            <th>Home Work</th>
                            <th>Holiday Assignment</th>
                            <th>Summative Test</th>
                            <th>Exam</th>
                            
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="subject in assignedSubjects" :key="subject.id">
                            <th scope="row">{{ subject.name }}</th>
                            <td>{{subject.home_work}}</td>
                            <td>{{subject.holiday_assignment}}</td>
                            <td>{{subject.summative_test}}</td>
                            <td>{{subject.exam}}</td>
                            <td><a href="#" data-target="#exampleModal2" v-on:click="deleteSubject(student_id, subject.id)" data-toggle="modal">Delete</a></td>
                          </tr>
                        </tbody>
                        
                      </table>
                    </div>
                  </div>
              </div>
              </div>

            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">Students List</div>
          <div class="card-body">

            <table class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Surname</th>
                  <th>Other name</th>
                  <th>Email</th>
                  <th>DOB</th>
                  <th>Gender</th>
                  <th>Age</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody v-if="s.length > 0">
                  
                <tr v-for="st in s" :key="st.id" >
                  <th scope="row">{{ st.roll_no }}</th>
                           <td>{{ st.surname}}</td>
                            <td>{{ st.name}}</td>
                            <td>{{ st.email}}</td> 
                            <td>{{ st.dob}}</td>
                            <td>{{ st.gender}}</td>
                            <td>{{st.identifi}}</td>
                          <td>

                            <a :href="'http://127.0.0.1:8000/api/studentSubject/'+ st.id" class="btn btn-info text-white rounded-circle mr-3">View Subjects</a>
                          </td>
                  <td><a href="#"
                       v-on:click="unassignedSubjectsList(st.id)"
                       data-target="#exampleModal1"
                       data-toggle="modal"
                       v-bind:title="st.name">Assign Subjects</a></td>
                </tr>
              </tbody>
             <span v-else> No Student has been added to this class</span>
            </table>
            <pagination :data="s" :limit="2" @pagination-change-page="studentLists">
              <span slot="prev-nav">&lt; Previous</span>
              <span slot="next-nav">Next &gt;</span>
            </pagination>
          </div>
        </div>

      </div>
    </div>
  

</template>

<script>

  export default {
      
    data() {
        
      return {
           
        students: {},
        assignedSubjects: [],
        unassignedSubjects: [],
        student_id: '',
        subject_id: '',
        id: '',
        succmsg: true,
        showmodal: false,
        actionmsg: '',
        s:[],
        
        
      }
    },
    
    methods: {
      studentLists(page) {
          
        
        if (typeof page === 'undefined') {
          page = 1
        }
        this.$http.get('http://127.0.0.1:8000/api/students?page=' + page).then(response => {
          //this.posts = response.data.data;
          this.students = response.data
          this.pagenumber = page

          
        })
      },
      
     getAge(birthDate){
      return Math.floor((new Date() - new Date(birthDate).getTime()) / 3.15576e+10)
    },
      unassignedSubjectsList(student) {
        this.$http.get('http://127.0.0.1:8000/api/students/'+student+'/unassignedsubjects').then(response => {
          this.unassignedSubjects = response.data;
          this.student_id = student;
          this.assignedSubjectsList(student);
        })
      },
      assignedSubjectsList(student) {
        this.$http.get('http://127.0.0.1:8000/api/students/'+student+'/assignedsubjects').then(response => {
          this.assignedSubjects = response.data
        })
      },
      
      assignSubject(student_id, subject_id){
        this.$http
          .post('http://127.0.0.1:8000/api/students/'+student_id+'/assignsubject/'+subject_id, {
            student_id: this.student_id,
            subject_id: this.subject_id,
          })
          .then(data => {
            this.subject_id = '';
            this.assignedSubjectsList(student_id);
            this.unassignedSubjectsList(student_id);
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
          })
      },
      deleteSubject(student_id, subject_id) {
        this.$http
          .delete('http://127.0.0.1:8000/api/students/'+student_id+'/deletesubject/'+subject_id, {
            student_id: this.student_id,
            subject_id: this.subject_id,
          })
          .then(data => {
            this.subject_id = '';
            this.assignedSubjectsList(student_id);
            this.unassignedSubjectsList(student_id);
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
          })
      },
      deleteId(studentid) {
        this.id = studentid
      },
      // studentSubject(student_id){
      //     this.$http.get('http://127.0.0.1:8000/api/studentsubjects/'+student_id).then(response => {
      //       this.studentSubjects = response.data
      //   })
      // },
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
    props:['studs'],
    mounted() {
      this.studentLists();
      this.s = this.studs
      
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
