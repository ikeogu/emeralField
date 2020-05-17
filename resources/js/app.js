
require('./bootstrap');

window.Vue = require('vue');





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
//  import VueRouter from 'vue-router';

//  import { routes } from './routes';
 
 Vue.component('pagination', require('laravel-vue-pagination'));
 Vue.use(VueResource);
 Vue.use(BootstrapVue);
 Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr("content");

    // Vue.use(VueRouter);
    // const router = new VueRouter({
    //     mode: 'history',
    //     routes
    // });
    // export const routes = [
    //     { path: '/subjects', component: subjects, name: 'Subject' },
    //     { path: '/vue/example', component: Example, name: 'Example' }
    // ];
 


 const app = new Vue({
     el: '#app',
     
     components: {
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
         'termclasses':termclasses
     }
 });
