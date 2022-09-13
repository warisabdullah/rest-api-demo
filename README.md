endpoints

Users 
1-Create User {url}/api/users/store
body =[
first_name last_name email description
]
2-Delete User {url}/api/users/delete 
body =[
user_id
]
3-User List {url}/api/users 
body(optional-filters) =[
first_name group_name sort_by_first_name sort_by_last_name sort_by_group_count
]

4-Assign User To Group {url}/api/assign-group
body = [
user_id
group_id[] //send One for single assign and multiple for mass assign as an array
] 
5-Remove User From Group {url}/api/unassign-group
body = [
same as assign
] 


Groups

1-Create Group {url}/api/groups/store
body =[
name
]

2-Delete Group {url}/api/groups/delete
body =[
group_id
]

3-Group List {url}/api/groups
