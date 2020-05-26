
require('./bootstrap');

window.Vue = require('vue');



import 'es6-promise/auto'
import axios from 'axios'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
// import Index from './Index'
import auth from './auth'
import router from './router'
 import students from './students/index.vue';
 import classes from './class/index.vue';
 import term from './class/term.vue';
 import subjectAssignment from './students/subjectAssignment.vue';
 import studentList from './result/studentList.vue';
 import subjects from './subjects/index.vue';
 import gradeSettings from './gradeSettings/index.vue';
 import marksFeeding from './marksFeeding/index.vue';
 import teachers from './teachers/index.vue';
 import VueResource from 'vue-resource';
 import BootstrapVue from 'bootstrap-vue';
 import studentclass from  './class/student-class.vue';
 import studentRecord from './students/student-record.vue';
 import termclasses from './class/termClass.vue';
 import Register from './pages/Register'
import Login from './pages/Login';
import Biodata from './students/biodata'



//  import VueRouter from 'vue-router';

//  import { routes } from './routes';
 
 Vue.component('pagination', require('laravel-vue-pagination'));
 Vue.use(VueResource);
 Vue.use(BootstrapVue);
 Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr("content");

// Set Vue router
// Vue.router = router
// Vue.use(VueRouter)
// Set Vue authentication
// Vue.use(VueAxios, axios)
// axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
// Vue.use(VueAuth, auth)
// Load Index


 const app = new Vue({
    
     el: '#app',
     
    components: {
         'login':Login,
         'register':Register,
         'students':  students,
         'subjects': subjects,
         'student-subjects': subjectAssignment,
         'grade-settings': gradeSettings,
         'marks-feeding': marksFeeding,
         'result-student-list': studentList,
         'teachers':teachers,
         'classes':classes,
         'student-class':studentclass,
         'student-record':studentRecord,
         'term':term,
         'termclasses':termclasses,
         'biodata':Biodata
    }
 });
 
