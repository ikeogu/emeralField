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
             id="exampleModal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             v-bind:class="{ showmodal:showmodal }">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Mark to Subjects</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
              </div>
              <div class="modal-body">
                <form v-if="student_details.level === 'High School'" method="post" name="assignMark" id="assignsubjects" action="#" @submit.prevent="assignMark">

                   <div class="form-group">
                    <label for="roll_no">CAT 1</label>
                    <input type="text" name="CAT1"  class="form-control" placeholder="Enter CAT 1 Score" v-model="student_mark.CAT1" />
                  </div>

                  <div class="form-group">
                    <label for="roll_no">CAT 2</label>
                    <input type="number" name="CAT2" class="form-control" placeholder="Enter CAT 2 Score" v-model="student_mark.CAT2" />
                  </div>
                  <div class="form-group">
                    <label for="contact">MSC</label>
                    <input type="number" name="MSC"  class="form-control" placeholder="Enter MSC Score" v-model="student_mark.msc" />
                  </div>
                  <div class="form-group">
                    <label for="contact">Exam</label>
                    <input type="number" name="exam"  class="form-control" placeholder="Enter MSC Score" v-model="student_mark.exam" />
                  </div>

                  <div class="form-group text-center">
                    <button class="btn btn-success">Submit</button>
                  </div>
                </form>
                 <form v-if="student_details.level === 'Year School'" method="post" name="assignMArk" id="assignsubjects" action="#" @submit.prevent="assignMark">

                   <div class="form-group">
                    <label for="roll_no">Home Work</label>
                    <input type="number" name="HW"  class="form-control"  v-model="student_mark.HW" />
                  </div>
                  <div class="form-group">
                    <label for="roll_no">Class Work</label>
                    <input type="number" name="CW" class="form-control" placeholder="Enter CAT 2 Score" v-model="student_mark.CW" />
                  </div>
                  <div class="form-group">
                    <label for="contact">Friday Assignment</label>
                    <input type="number" name="FT"  class="form-control" v-model="student_mark.FT" />
                  </div>
                  <div class="form-group">
                    <label for="roll_no">Holiday Assignment</label>
                    <input type="number" name="HA"  class="form-control"  v-model="student_mark.HA" />
                  </div>
                  <div class="form-group">
                    <label for="roll_no">Summative Test</label>
                    <input type="number" name="summative_test" class="form-control" placeholder="Enter CAT 2 Score" v-model="student_mark.summative_test" />
                  </div>
                  <div class="form-group">
                    <label for="contact">TCA</label>
                    <input type="number" name="TCA"  class="form-control" v-model="student_mark.TCA" />
                  </div>
                  <div class="form-group">
                    <label for="contact">Exam</label>
                    <input type="number" name="exam"  class="form-control" v-model="student_mark.exam" />
                  </div>

                  <div class="form-group text-center">
                    <button class="btn btn-success">Submit</button>
                  </div>
                </form>
               
               <span v-else></span>

              </div>

            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header"> {{assignedSubjects.length}} Subject's Record</div>
            <div class="card-body">

              <div class="row" v-if="student_details.level === 'High School'">
                <div class="col-4">
                  <div  class="table-wrapper "> 
                    <table  class="table " >
                        <thead >
                            <th>Subject</th>
                        </thead>
                        <tbody>
                          <tr v-for="subject in assignedSubjects" :key="subject.id" >
                            <td>{{subject.name}}</td>
                            <td>
                            <a href="#"
                                data-target="#exampleModal"
                                data-toggle="modal"
                                v-on:click="getSubjectID(subject.id)"
                                class="btn btn-success" >Add Score
                            </a>
                            </td>
                          </tr>
                        </tbody>
                    </table>
                  </div>  
                </div>
                <div class="col-8">
                  <table  class="table-wrapper" >
                    <thead >
                        <th>CAT 1</th>
                        <th>CAT 2</th>
                        <th>MSC</th>
                        <th>Exam</th>
                        <th>Grand Total</th>
                        <th>Action</th>  
                    </thead>
                    <tbody>
        
                      <tr v-for="marks in scores" :key="marks.id" :subject_id="marks.subject_id">
                        
                          <td>{{marks.CAT1}}</td>
                           <td>{{marks.CAT2}}</td>
                           <td>{{marks.MSC}}</td>
                            <td>{{marks.Exam}}</td>
                            <td>{{marks.GT}}</td>
                       
                          <td>  
                            
                              <a href="#"
                               v-on:click="editScore(marks.id)"
                                data-target="#exampleModalEdit"
                                data-toggle="modal"
                                v-bind:title="marks.subject_id"
                                class="btn btn-success">Edit
                            </a>
                            
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div> 
             <div class="row" v-if="student_details.level === 'Year School'">
                <div class="col-4">
                  <div  class="table-wrapper "> 
                    <table  class="table " >
                        <thead >
                            <th>Subject</th>
                        </thead>
                        <tbody>
                          <tr v-for="subject in assignedSubjects" :key="subject.id" >
                            <td>{{subject.name}}</td>
                            <td>
                            <a href="#"
                                data-target="#exampleModal"
                                data-toggle="modal"
                                v-on:click="getSubjectID(subject.id)"
                                class="btn btn-success" >Add Score
                            </a>
                            </td>
                          </tr>
                        </tbody>
                    </table>
                  </div>  
                </div>
                <div class="col-8">
                  <table  class="" >
                    <thead >
                        <th>Hw</th>
                        <th>CW</th>
                        <th>HA</th>
                        <th>FT</th>
                        <th>S.T</th>
                        <th>TCA</th>
                        <th>Exam</th>
                        <th>Grand Total</th>
                        <th>Action</th>  
                    </thead>
                    <tbody>
        
                      <tr v-for="marks in scores" :key="marks.id" :subject_id="marks.subject_id">
                        
                          <td>{{marks.HW}}</td>
                           <td>{{marks.CW}}</td>
                           <td>{{marks.HA}}</td>
                            <td>{{marks.FT}}</td>
                            <td>{{marks.Summative_test}}</td>
                            <td>{{marks.FT + marks.Summative_test +marks.HA + marks.CW +marks.HW}}</td>
                            <td>{{marks.Exam}}</td>
                            <td>{{marks.GT}}</td>
                       
                          <td>  
                            
                              <a href="#"
                               v-on:click="editScore(marks.id)"
                                data-target="#exampleModalEdit"
                                data-toggle="modal"
                                v-bind:title="marks.id"
                                class="btn btn-success">Edit
                            </a>
                            
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div> 
              <!-- Still need to do table for creche -->
            </div>
          </div>
        </div>
      </div>

      <!-- edit -->
      <div class="modal fade"
             id="exampleModalEdit"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             v-bind:class="{ showmodal:showmodal }">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Score</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
              </div>
              <div class="modal-body">
                <form method="post" name="updatescore" id="updatescore" action="#" @submit.prevent="updateScore" v-if="student_details.level === 'High School'">

                   <div class="form-group">
                    <label for="roll_no">CAT 1</label>
                    <input type="text" name="CAT1"  class="form-control" placeholder="Enter CAT 1 Score" v-model="student_mark.CAT1" />
                  </div>

                  <div class="form-group">
                    <label for="roll_no">CAT 2</label>
                    <input type="number" name="CAT2" class="form-control" placeholder="Enter CAT 2 Score" v-model="student_mark.CAT2" />
                  </div>
                  <div class="form-group">
                    <label for="contact">MSC</label>
                    <input type="number" name="MSC"  class="form-control" placeholder="Enter MSC Score" v-model="student_mark.MSC" />
                  </div>
                  <div class="form-group">
                    <label for="contact">Exam</label>
                    <input type="number" name="exam"  class="form-control" placeholder="Enter MSC Score" v-model="student_mark.Exam" />
                  </div>

                  <div class="form-group text-center">
                    <button class="btn btn-success">Update</button>
                  </div>
                </form>
                 <form v-if="student_details.level === 'Year School'" method="post" name="updatescore" id="updatescore" action="#" @submit.prevent="updateScore">

                   <div class="form-group">
                    <label for="roll_no">Home Work</label>
                    <input type="number" name="HW"  class="form-control"  v-model="student_mark.HW" />
                  </div>
                  <div class="form-group">
                    <label for="roll_no">Class Work</label>
                    <input type="number" name="CW" class="form-control" placeholder="" v-model="student_mark.CW" />
                  </div>
                  <div class="form-group">
                    <label for="contact">Friday Assignment</label>
                    <input type="number" name="FT"  class="form-control" v-model="student_mark.FT" />
                  </div>
                  <div class="form-group">
                    <label for="roll_no">Holiday Assignment</label>
                    <input type="number" name="HA"  class="form-control"  v-model="student_mark.HA" />
                  </div>
                  <div class="form-group">
                    <label for="roll_no">Summative Test</label>
                    <input type="number" name="summative_test" class="form-control"  v-model="student_mark.summative_test" >
                  </div>
                  
                  <div class="form-group">
                    <label for="contact">Exam</label>
                    <input type="number" name="exam"  class="form-control" v-model="student_mark.Exam" />
                  </div>

                  <div class="form-group text-center">
                    <button class="btn btn-success">Update</button>
                  </div>
                </form>
               
               <span v-else></span>
              </div>

            </div>
          </div>
        </div>
    </div>
  
    
</template>

<script src="https://vuejs.org/js/vue.min.js"></script>
<script>

  export default {
    data() {
      return {
        itemsPerRow:5,
        students: {},
        assignedSubjects: [],
        unassignedSubjects: [],
        assignedMarks:{},
        scores:{},
        
        student_id: '',
        
        sub_id: '',
        student_details :'',
        succmsg: true,
        showmodal: false,
        actionmsg: '',
        id:'',
        student_mark:{
          id:'',
          subject_id:'',
          student_id: '',
          HA:'',
          CW:'',
          HW:'',
          FT:'',
          summative_test:'',
          CAT1:'',
          CAT2:'',
          Exam:'',
          MSC:'',
          
        }
      }
    },
    
    methods: {
      scoreLists(page) {
        if (typeof page === 'undefined') {
          page = 1
        }
        this.$http.get('http://127.0.0.1:8000/api/subjectMarks/'+ this.student_details.id).then(response => {
          
          this.scores = response.data
         
          this.pagenumber = page
        })
      },
      
    
     getSubjectID(id){
      this.student_mark.subject_id = id  
       
     },
      
      assignMark() {
        this.$http
          .post('http://127.0.0.1:8000/api/subjectMark',{
            student_id: this.student_details.id,
            subject_id: this.student_mark.subject_id,
            
             HA:this.student_mark.HA,
              CW:this.student_mark.CW,
              HW:this.student_mark.HW,
              FT:this.student_mark.FT,
              summative_test:this.student_mark.summative_test,
              CAT1:this.student_mark.CAT1,
              CAT2:this.student_mark.CAT2,
              exam:this.student_mark.exam,

          })
          .then(data => {
            this.succmsg = false
            
            this.subject_id = '';
            
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Score added successfully'
            
            $('#exampleModal').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            this.scoreLists(this.pagenumber)
          })
      },
      editScore(markid) {
        this.$http.get('http://127.0.0.1:8000/api/subjectMark/' + markid).then(data => {
          
          this.student_mark.subject_id = data.data.data.subject_id
          this.student_mark.student_id = data.data.data.student_id
          this.student_mark.HW = data.data.data.HW
          this.student_mark.CW = data.data.data.CW
          this.student_mark.FT = data.data.data.FT
          this.student_mark.summative_test = data.data.data.summative_test
          this.student_mark.CAT1 = data.data.data.CAT1
          this.student_mark.CAT2 = data.data.data.CAT2
          this.student_mark.MSC = data.data.data.MSC
          this.student_mark.Exam = data.data.data.Exam
          this.student_mark.id = markid
        })
        
      },
      updateScore() {
        this.$http
          .patch('http://127.0.0.1:8000/api/subjectMark/' + this.student_mark.id, {
            student_id: this.student_details.id,
            subject_id: this.student_mark.subject_id,
            
             HA:this.student_mark.HA,
              CW:this.student_mark.CW,
              HW:this.student_mark.HW,
              FT:this.student_mark.FT,
              summative_test:this.student_mark.summative_test,
              CAT1:this.student_mark.CAT1,
              CAT2:this.student_mark.CAT2,
              MSC:this.student_mark.MSC,
              
              Exam:this.student_mark.Exam,
              my_id:this.student_mark.id
              
          })
          .then(data => {
            this.succmsg = false
           
            this.student_details.id = '';
            this.student_mark.subject_id= '';
            
            this.student_mark.HA= '';
            this.student_mark.CW= '';
            this.student_mark.HW= '';
            this.student_mark.FT= '';
            this.student_mark.summative_test= '';
            this.student_mark.CAT1= '';
            this.student_mark.CAT2= '';
            this.student_mark.Exam= '';
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Score updated successfully'
            $('#exampleModalEdit').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            this.scoreLists(this.pagenumber)
          })
      },
      deleteSubject(student_id, subject_id) {
        this.$http
          .delete('http://127.0.0.1:8000/api/students/'+student_id+'/deletesubject/'+subject_id, {
            student_id: this.student_id,
            subject_id: this.subject_id,
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.subject_id = '';
            this.assignedSubjectsList(student_id);
            this.unassignedSubjectsList(student_id);
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Score inserted successfully'
            
            $('#exampleModal').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            this.scoreLists(this.pagenumber)
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
    props:['studs_data','s_details'],
    
    mounted() {
      
      this.assignedSubjects = this.studs_data
      this.student_details = this.s_details
      this.assignedMarks = this.sub_mark
      
      this.scoreLists()
      
      
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

    .table-wrapper {
  max-width: 1200px;
  overflow: scroll;
}

table {
  position: relative;
  border: 1px solid #ddd;
  border-collapse: collapse;
}

td, th {
  white-space: nowrap;
  border: 1px solid #ddd;
  padding: 20px;
  text-align: center;
}

th {
  background-color: #eee;
  position: sticky;
  top: -1px;
  z-index: 2;
  
  /* &:first-of-type {
    left: 0;
    z-index: 3;
  } */
}

tbody tr td:first-of-type {
  background-color: #eee;
  position: sticky;
  left: -1px;
  text-align: left;
}
</style>
