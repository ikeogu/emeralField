

<template>
  
  
  <div id="postsrec" class="mt-5">

    <div class="row mt-5">
      <div class="col-lg-12 text-right" style="margin-bottom: 20px;">
        <a href="#"
           data-target="#exampleModal"
           data-toggle="modal"
           class="btn btn-success">Add New Term</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Term</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <form method="post" name="addterm" id="addclass" action="#" @submit.prevent="addTerm">
                  <div class="form-group">
                    <label for="name">Term </label>
                    <div class="form-group">
                    <select class="form-control" name="name" v-model="selected" v-on:change="getText">
                      <option>Choose Option</option>
                      <option v-for="option in options" v-bind:value="option.value" :key="option.value">
                          {{option.text}}
                      </option>
                    </select>
                </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="First term...." v-model="term.description" />
                  </div>
                  <div class="form-group">
                    <label for="name">Session</label>
                    <input type="text" name="session" id="session" class="form-control" placeholder="2019/2020" v-model="term.session" />
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Term</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
              </div>
              <div class="modal-body">
                <form method="post" name="updateterm" id="updateclass" action="#" @submit.prevent="updateTerm">
                  
                    <div class="form-group">
                    <label for="name">Term </label>
                    <div class="form-group">
                    <select class="form-control" name="name" v-model="selected" v-on:change="getText">
                      <option>Choose Option</option>
                      <option v-for="option in options" v-bind:value="option.value" :key="option.value">
                          {{option.text}}
                      </option>
                    </select>
                </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="First term...." v-model="term.description" />
                  </div>
                  <div class="form-group">
                    <label for="name">Session</label>
                    <input type="text" name="session" id="session" class="form-control" placeholder="2019/2020" v-model="term.session" />
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
                  <button class="btn btn-success" v-on:click="deleteClass()">Ok</button>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="modal fade"
             id="exampleModal23"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             v-bind:class="{ showmodal:showmodal }">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Classes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
              </div>
              <div class="modal-body">
                <form v-if="this.unassignedClasses.length > 0" method="post" name="assignClass" id="assignClass" action="#" @submit.prevent="assignClass(term_id, class_id)">

                  <div class="form-group">
                    <label for="gender">Assign Class</label>
                    <select class="form-control" name="class_id"  v-model="class_id">
                          <option v-for="classes in unassignedClasses"  :key="classes.id" v-bind:value="classes.id">{{ classes.name }}</option>
                    </select>
                  </div>

                  <div class="form-group text-center">
                    <button class="btn btn-success">Submit</button>
                  </div>
                </form>
                <span v-else>All Classes Assigned to this Term!</span>
                <br>

                <span class="mt-3">Assigned Classes</span>
                <table class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Classes</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="classes in assignedClasses" :key="classes.id">
                      <th scope="row">{{ classes.name }}</th>
                      <td><a href="#" data-target="#exampleModal2" v-on:click="deleteClass(term_id, classes.id)" data-toggle="modal">Delete</a></td>
                    </tr>
                  </tbody>
                  
                </table>
              </div>

            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">Term List</div>
          <div class="card-body">

            <table class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th> Name</th>
                  <th>Description</th>
                  <th>Session</th>
                  <th>Classes</th>
                  <th></th>
                  <th colspan="2">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="term in laravelData.data" :key="term.id">
                  <td>{{ term.name }}</td>
                  <td>{{ term.description }}</td>
                  <td>{{ term.session }}</td>
                  
                  <td>
                    <a :href="'http://127.0.0.1:8000/api/terms_classes/' + term.id" class="btn btn-success text-white">view Classes</a>
                  </td>
                  <!-- link to student in a class -->
                  <td>
                      <a class="btn btn-info text-white" 
                      v-on:click="unassignedClassList(term.id)"
                       data-target="#exampleModal23"
                       data-toggle="modal"
                       v-bind:title="term.name" > Assign Class</a>
                      <a href="#"
                       v-on:click="editTerm(term.id)"
                       data-target="#exampleModal1"
                       data-toggle="modal"
                       v-bind:title="term.name" class="btn btn-warning">Edit</a>
                       
                    </td>

                  <td>
                      <a href="#" data-target="#exampleModal2" v-on:click="deleteId(term.id)" data-toggle="modal" v-bind:id="id" class="btn btn-danger">Delete</a></td>
                </tr>
              </tbody>
              
            </table>
            <pagination :data="laravelData" :limit="2" @pagination-change-page="termLists">
              <span slot="prev-nav">&lt; Previous</span>
              <span slot="next-nav">Next &gt;</span>
            </pagination>
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
           
           terms:{},
           assignedClasses: [],
           unassignedClasses: [],
           term_id:'',
           class_id:'',
            
          term : {
              term_id: '',
              name:'',
              session:'',
              description:'',
              
          },
        selected:"Choose Options",
        options: [
                { value: 1, text: 'Term 1' },
                { value: 2, text: 'Term 2' },
                { value: 3, text: 'Term 3' }
        ],
        laravelData: {},
        
        id: '',
        succmsg: true,
        showmodal: false,
        pagenumber: 1,
        actionmsg: ''
      }
    },
    methods: {
      termLists(page) {
        if (typeof page === 'undefined') {
          page = 1
        }
        this.$http.get('http://127.0.0.1:8000/api/terms?page=' + page).then(response => {
          //this.posts = response.data.data;
          this.laravelData = response.data
          this.pagenumber = page
        })

       
              
      },
        
      
      getText () {
        var values = this.options.map(function(o) { return o.value })
        var index = values.indexOf(this.selected) 
        this.term.name = this.options[index].text
      },
      
      addTerm() {
        this.$http
          .post('http://127.0.0.1:8000/api/terms', {
            name: this.term.name,
            description: this.term.description,
            session: this.term.session,
            
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.term.name = ''
            this.term.description = ''
                        
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Term  Added successfully'
            $('#exampleModal').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            this.termLists(this.pagenumber)
          })
      },
      editTerm(termid) {
        this.$http.get('http://127.0.0.1:8000/api/terms/' + termid).then(data => {
          this.term.name = data.data.data.name
          this.term.description = data.data.data.description,
          this.term.session = data.data.data.session
          
          this.id = termid
        })
      },
      updateTerm() {
        this.$http
          .put('http://127.0.0.1:8000/api/terms/' + this.id, {
            term_id:this.id,
            name: this.term.name,
            description:this.term.description,
            session:this.term.session,
            
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.term.name = ''
            this.term.description = ''
            
            
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Term updated successfully'
            $('#exampleModal1').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            this.termLists(this.pagenumber)
          })
      },
        unassignedClassList(term) {
        this.$http.get('http://127.0.0.1:8000/api/terms/'+term+'/unassignedterms').then(response => {
          this.unassignedClasses = response.data;
          this.term_id = term;
          this.assignedClassList(term);
        })
      },
      assignedClassList(term) {
        this.$http.get('http://127.0.0.1:8000/api/terms/'+term+'/assignedterms').then(response => {
          this.assignedClasses = response.data
        })
      },
      assignClass(term_id, class_id){
        this.$http
          .post('http://127.0.0.1:8000/api/term/'+term_id+'/assignclass/'+class_id, {
            term_id: this.term_id,
            class_id: this.class_id,
          })
          .then(data => {
            this.term_id = '';
            this.assignedClassList(term_id);
            this.unassignedClassList(term_id);
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
          })
      },
      deleteClass(term, cls) {
        this.$http
          .delete('http://127.0.0.1:8000/api/terms/'+term+'/deleteclass/'+cls, {
            term_id: this.term_id,
            class_id: this.class_id,
          })
          .then(data => {
            this.class_id = '';
            this.assignedSubjectsList(class_id);
            this.unassignedSubjectsList(class_id);
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
          })
      },
   
      deleteId(termid) {
        this.id = termid
      },
      deleteTerm() {
        this.$http.delete('http://127.0.0.1:8000/api/terms/' + this.id).then(data => {
          this.succmsg = false
          var self = this
          setTimeout(function() {
            self.succmsg = true
          }, 3000)

          this.actionmsg = 'Term deleted successfully'
          this.subjectLists(this.pagenumber)
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
      },
      
    },
    mounted() {
          
            
      this.termLists()
      
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
