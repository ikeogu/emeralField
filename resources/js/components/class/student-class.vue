<template>

  <div id="postsrec" class="mt-5">
      <div class="row mt-5">
      <div class="col-lg-12 text-right" style="margin-bottom: 20px;">
        <a href="#"
           data-target="#exampleModalCenter"
           data-toggle="modal"
           class="btn btn-success">Add Student</a>
      </div>
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Add Student</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" name="addStudent" id="addStudent" action="#" @submit.prevent="addStudent">
              <div class="row">
                <div class="md-form active-purple active-purple-2 mb-3 col-9">
                  <input class="form-control" type="hidden" placeholder="Search" aria-label="Search" v-model="add_student.term_id">
                 <ejs-autocomplete :dataSource='sportsData' :fields='fields' sortOrder='sortOrder' :query='query'  :placeholder="waterMark" :itemTemplate='iTemplate'  v-model="add_student.stud_id" popupHeight="450px" ></ejs-autocomplete>
                                    
                </div>
                <div class="col-3">
                    <ejs-button  class="btn btn-success">Add</ejs-button>
              
                </div>
              </div> 
        
              </form>
                
             

                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
          </div>
        </div>
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
             id="exampleModal1"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             v-bind:class="{ showmodal:showmodal }">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Subjects</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
              </div>
              <div class="modal-body">
                <form v-if="this.unassignedSubjects.length > 0" method="post" name="assignsubjects" id="assignsubjects" action="#" @submit.prevent="assignSubject(student_id, subject_id,T_id)">

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
                     <div class="table-responsive">
            
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
        </div>

        <div class="card">
          <div class="card-header bg-success text-white">Students List</div>
          <div class="card-body">
               <div class="table-responsive">
            
            <table class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Surname</th>
                  <th>Other name</th>
                  <th>Email</th>
                  
                  <th>Gender</th>
                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody v-if="s.length > 0">
                  
                <tr v-for="st in s" :key="st.id" >
                  <th scope="row">{{ st.roll_no }}</th>
                           <td>{{ st.surname}}</td>
                            <td>{{ st.name}}</td>
                            <td>{{ st.email}}</td> 
                            
                            <td>{{ st.gender}}</td>
                            
                          <td>

                            <a :href="'http://127.0.0.1:8000/api/studentSubject/'+st.id+'/term/'+T_id.id+'/class/'+myId.id" 
                            class="btn btn-warning text-white  ">View Subjects</a>
                          </td>
                  <td><a href="#" class="btn btn-success text-white"
                       v-on:click="unassignedSubjectsList(st.id)"
                       data-target="#exampleModal1"
                       data-toggle="modal"
                       v-bind:title="st.name">Assign Subjects</a></td>
                       <td><a href="#" class="btn btn-danger text-white"
                       v-on:click="deleteId(st.id)"
                       data-target="#exampleModal1"
                       data-toggle="modal"
                       v-bind:title="st.name">Remove</a></td>
                </tr>
              </tbody>
             <span v-else> No Student has been added to this class</span>
            </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  

</template>

<script>
import { Query, DataManager, ODataV4Adaptor } from '@syncfusion/ej2-data';
import { ButtonPlugin } from '@syncfusion/ej2-vue-buttons';

import Vue from 'vue';
Vue.use(ButtonPlugin);
var itemVue = Vue.component("itemTemplate", {
  template: `<span><span class='surname'> {{data.surname}} </span><span class ='name'> {{data.name}}</span></span>`,
  data() {
    return {
      data: {}
    };
  }
});

  var remoteData = new DataManager({
    url: 'http://127.0.0.1:8000/api/allstudents',
    adaptor: new ODataV4Adaptor,
    crossDomain: true
});
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
        s:{},
        query: '',
        
        T_id :'',
        chosen: '',
        item: {},
        add_student: {
          term_id : '',
          stud_id: '',
        },
        myId:'', 
        

        waterMark : 'search student name',
        sportsData: remoteData,
        fields: {value: 'id'  },
         iTemplate: function(e) {
                return {
                    template: itemVue
                };
            },
        query: new Query().select(['name', 'id']),
      sortOrder: 'Ascending'
 
        
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
      autoComplete(){
          this.results = [];
          if(this.query.length > 2){
            this.$http.get('/api/search',{params: {query: this.query}}).then(response => {
            this.results = response.data;
            });
          }
      },
      addStudent() {
         this.add_student.term_id  = this.T_id.id,
        this.$http
          .post('http://127.0.0.1:8000/api/add_student_class/'+this.add_student.stud_id+'/term/'+ this.add_student.term_id +'/class/'+this.myId.id , {
             term_id: this.add_student.term_id ,
            student_id: this.add_student.stud_id,
            class_id:this.myId.id
          })
          .then(data => {
            this.student_id = '';
            
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Student Added successfully!'
          
          $('#exampleModalCenter').modal('hide')
          $('body')
            .removeClass()
            .removeAttr('style')
          $('.modal-backdrop').remove()
        
          })
       
          
        
      },
      
      unassignedSubjectsList(student,term_id) {
        this.$http.get('http://127.0.0.1:8000/api/students/'+student+'/unassignedsubjects/class/'+this.myId.id+'/term/'+this.T_id.id).then(response => {
          this.unassignedSubjects = response.data;
          this.student_id = student;
          
          this.assignedSubjectsList(student);
        })
      },
      assignedSubjectsList(student,term_id) {
        this.$http.get('http://127.0.0.1:8000/api/students/'+student+'/assignedsubjects/class/'+this.myId.id+'/term/'+this.T_id.id).then(response => {
          this.assignedSubjects = response.data
        })
      },
      
      assignSubject(student_id, subject_id,term_id){
        this.$http
          .post('http://127.0.0.1:8000/api/students/'+student_id+'/assignsubject/'+subject_id+'/class/'+this.myId.id+'/term/'+this.T_id.id, {
            student_id: this.student_id,
            subject_id: this.subject_id,
            term_id : this.T_id.id
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
          .delete('http://127.0.0.1:8000/api/students/'+student_id+'/deletesubject/'+subject_id+'/class/'+this.myId.id+'/term'+this.T_id.id, {
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
        this.deleteStudent(this.id)
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
    props:['terms','t','m'],
    mounted() {
      this.studentLists();
      this.s = this.terms,
      this.T_id =this.t,
      this.myId = this.m
      
      
      
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

@import "../../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "../../../../node_modules/@syncfusion/ej2-vue-dropdowns/styles/material.css";

  #app {
    color: #008cff;
    height: 40px;
    left: 35%;
    position: absolute;
    top: 35%;
    width: 30%;
  }
  #btn {
  margin:40px auto;
  display:block;
  background-color: green;
}

</style>
