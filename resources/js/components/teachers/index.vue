<template>

  <div id="postsrec" class="mt-5">

    <div class="row mt-5">
      <div class="col-lg-12 text-right" style="margin-bottom: 20px;">
        <a href="#"
           data-target="#exampleModal"
           data-toggle="modal"
           class="btn btn-primary">Add Teacher</a>
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
                <form method="post" name="addteacher" id="addteacher" action="#" @submit.prevent="addTeacher">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" v-model="teacher.name" />
                  </div>
                  <div class="form-group">
                    <label >Start Year</label>
                    <input type="text" name="start_year"  class="form-control" placeholder="Year Started Work" v-model="teacher.start_year"
                    />
                  </div>
                  
                  <div class="form-group">
                    <label for="address">Choose status</label>
                    <select class="form-control" name="status" v-model="teacher.status"  placeholder="Choose Status">
                      
                     <option>Choose Status</option>
                     <option value="Corp member">Corp Member</option>
                     <option valie="Full Staff">Full Staff</option>
                    
                    </select>
                </div>

                  <div class="form-group">
                    <label for="address">Choose a Class</label>
                    <select class="form-control" name="level" v-model="teacher.level"  placeholder="Choose Class">
                      
                     <option>Choose Level</option>
                     <option value="High School">High School</option>
                     <option valie="Year School">Year School</option>
                     <option value="Early Years">Early Years</option>
                    </select>
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
                <form method="post" name="updateteacher" id="updateteacher" action="#" @submit.prevent="updateTeacher">
                  <div class="form-group">
                    <label for="name">teacher Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" v-model="teacher.name" />
                  </div>
                  <div class="form-group">
                    <label >Start Year</label>
                    <input type="text" name="start_year"  class="form-control" placeholder="Year Started Work" v-model="teacher.start_year"
                    />
                  </div>
                  
                  <div class="form-group">
                    <label for="address">Choose status</label>
                    <select class="form-control" name="status" v-model="teacher.status"  placeholder="Choose Status">
                      
                     <option>Choose Status</option>
                     <option value="Corp member">Corp Member</option>
                     <option valie="Full Staff">Full Staff</option>
                    
                    </select>
                </div>
                 

                  <div class="form-group">
                    <label for="address">Choose a Class</label>
                    <select class="form-control" name="level" v-model="teacher.level"  placeholder="Choose Class">
                      
                     <option>Choose Level</option>
                     <option value="High School">High School</option>
                     <option valie="Year School">Year School</option>
                     <option value="Early Years">Early Years</option>
                    </select>
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
                  <button class="btn btn-success" v-on:click="deleteteacher()">Ok</button>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Teachers </h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <th>#</th>
                  <th> Name</th>
                  <th>Start year</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th>Status</th>
                  <th>Subjects</th>
                  
                  <th colspan="2">Action</th>
                </thead>
              
                <tbody>
                    <tr v-for="teacher in laravelData.data" :key="teacher.id">
                    <th scope="row">{{ teacher.id }}</th>
                    <td>{{ teacher.name }}</td>
                    <td>{{ teacher.start_year }}</td>
                    <td>{{ teacher.email }}</td>
                    <td>{{ teacher.level }}</td>
                    <td>{{ teacher.status }}</td>
                    <td><a href="#"
                        v-on:click="editTeacher(teacher.id)"
                        data-target="#exampleModal1"
                        data-toggle="modal"
                        v-bind:title="teacher.name">Edit</a></td>
                    <td><a href="#" data-target="#exampleModal2" v-on:click="deleteId(teacher.id)" data-toggle="modal" v-bind:id="id">Delete</a></td>
                    </tr>
                </tbody>
              
             </table>
                <pagination :data="laravelData" :limit="2" @pagination-change-page="teacherLists">
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
        teacher: {
          teacher_id:'',
          name: '',
          start_year: '',
          level:'',
          status:'',

          
        },
        laravelData: {},
        laravelClassData:{},
        id: '',
        succmsg: true,
        showmodal: false,
        pagenumber: 1,
        actionmsg: ''
      }
    },
    ready: function() {
      this.fetchClasses();
      },
      
        
    methods: {

      fetchClasses() {
        this.$http.get('http://127.0.0.1:8000/api/schclasses').then(response => {
          //this.posts = response.data.data;
          this.laravelClassData = response.data
          
        })
      },
      
      teacherLists(page) {
        if (typeof page === 'undefined') {
          page = 1
        }
        this.$http.get('http://127.0.0.1:8000/api/teachers?page=' + page).then(response => {
          //this.posts = response.data.data;
          this.laravelData = response.data
          this.pagenumber = page
        })
      },
      addTeacher() {
        this.$http
          .post('http://127.0.0.1:8000/api/teachers', {
            
            start_year: this.teacher.start_year,
            level: this.teacher.level,
            status: this.teacher.status,
            name: this.teacher.name

          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.teacher.name = ''
            this.teacher.start_year = ''
            this.teacher.level= ''
            
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Teacher inserted successfully'
            
            $('#exampleModal').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            this.teacherLists(this.pagenumber)
          })
      },
      editTeacher(teacherid) {
        this.$http.get('http://127.0.0.1:8000/api/teachers/' + teacherid).then(data => {
          
          this.teacher.name = data.data.data.name
          this.teacher.start_year = data.data.data.start_year
          this.teacher.level = data.data.data.level
          this.teacher.status = data.data.data.status
          this.id = teacherid
        })
      },
      updateTeacher() {
        this.$http
          .patch('http://127.0.0.1:8000/api/teachers/' + this.id, {
            teacher_id:this.id,
            name: this.teacher.name,
            start_year: this.teacher.start_year,
            level: this.teacher.level,
            status: this.teacher.status,
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.teacher.name = ''
            this.teacher.start_year= ''
            this.teacher.level = ''
           
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Teacher updated successfully'
            $('#exampleModal1').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            this.teacherLists(this.pagenumber)
          })
      },
      deleteId(teacherid) {
        this.id = teacherid
      },
      deleteteacher() {
        this.$http.delete('http://127.0.0.1:8000/api/teachers/' + this.id).then(data => {
          this.succmsg = false
          var self = this
          setTimeout(function() {
            self.succmsg = true
          }, 3000)

          this.actionmsg = 'Teacher deleted successfully'
          this.teacherLists(this.pagenumber)
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
      this.teacherLists()
      
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
