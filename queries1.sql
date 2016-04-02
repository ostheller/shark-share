-- Select user information for user dashboard
SELECT first_name, last_name FROM users
WHERE id = ?; -- I think this way is better than user_name, yes?


-- Select User Data for user profile page
SELECT u.user_name, u.first_name, u.last_name, a.status, i.name, u.date_created, u.email, u.about_user
FROM users u
LEFT JOIN institutions i
ON u.institution_id = i.id
LEFT JOIN academic_statuses a
ON u.academic_status_id = a.id
WHERE u.id = ?; -- is this preferable to using 'user_name'?

-- update/edit user info user profile page (still trying to figure out how to do one line of this query.)
-- UPDATE users
-- figure out how to do SET colname = 'new value' for any option in the edit/update fields...
-- WHERE id = ?

-- delete user profile
DELETE FROM users
WHERE id = ?; -- do we need user_name = ? instead? I don't think we made it unique, just a string. How does that get enforced?

-- select all samples in user collection
SELECT * FROM samples
WHERE user_id = ?;