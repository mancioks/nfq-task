# Project management for schools

Application, where a teacher can create projects, groups and assign
students to groups.

## About

On a first visit, the application will show the project creation form to a
teacher (every project title should be unique). If any projects exist, the
teacher will be able to see the project list. When a project is created, a 
teacher will be able to add students to the created project. Student creation 
form implemented with REST API, so the page will not reload after each student 
creation. Student and group lists are also updated every 10 seconds, in case, 
more than one teacher will use this application, each teacher will see the 
latest information about students and groups without reloading the page. Every 
student in the project should have a unique full name (can be the same on 
different projects). When any student exists in the project, a teacher can 
assign students to the project group. If the student is assigned to a group 
and teacher want's to delete the student, the relationship with the group and 
the project also will be deleted.
