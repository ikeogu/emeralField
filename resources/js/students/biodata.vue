<template>

  <div id="postsrec" class="mt-5">

    <div class="row mt-3 jumbotron" style="margin-bottom: 20px;">
      
        <div class="col-4">  
            <h3>Welcome!</h3>
        </div>
        <div class="col-4"> 
             <h3>Student Name</h3>
        </div>
        <div class="col-4">
            <h4>Term</h4> 
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



        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Biodata</h6>
          </div>
           
                <div class="card-body">
                <!-- Nested Row within Card Body -->
                    <div class="row p-5 mt-3">
                        <form  class="user" method="post" name="updateteacher" id="updateteacher" action="#" @submit.prevent="updateTeacher">
                            <div class="form-group row ">
                                <div class="col-4">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="name" id="name" class="form-control form-control-user" placeholder="Name" v-model="teacher.name">
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-4">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="name" id="name" class="form-control form-control-user" placeholder="Name" v-model="teacher.name">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                            <div class="col-4">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="name" id="name" class="form-control form-control-user" placeholder="Name" v-model="teacher.name">
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="name" id="name" class="form-control form-control-user" placeholder="Name" v-model="teacher.name">
                                </div>
                            </div>
                            
                            <div class="form-group text-right">
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </form>
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
            this.actionmsg = 'Teachher updated successfully'
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
