const express = require('express');
const router = express.Router();
const db  = require('./dbConnection');
const { signupValidation, loginValidation } = require('./validation');
const { validationResult } = require('express-validator');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
router.post('/register', signupValidation, (req, res, next) => {  
db.query(
`SELECT * FROM users WHERE LOWER(email) = LOWER(${db.escape(
req.body.email
)});`,
(err, result) => {
if (result.length) {
return res.status(409).send({
msg: 'This user is already in use!'
});
} else {
// username is available
bcrypt.hash(req.body.password, 10, (err, hash) => {
if (err) {
return res.status(500).send({
msg: err
});
} else {
// has hashed pw => add to database
db.query(
`INSERT INTO users (first_name, last_name, email, mobile, password, status, role) VALUES ('${req.body.first_name}', '${req.body.last_name}', ${db.escape(
req.body.email
)}, '${req.body.mobile}', ${db.escape(hash)}, '1', 'client')`,
(err, result) => {
if (err) {
throw err;
return res.status(400).send({
msg: err
});
}
return res.status(201).send({
msg: 'The user has been registerd with us!'
});
}
);
}
});
}
}
);
});
router.post('/login', loginValidation, (req, res, next) => {
db.query(
`SELECT * FROM users WHERE email = ${db.escape(req.body.email)};`,
(err, result) => {
// user does not exists
if (err) {
throw err;
return res.status(400).send({
msg: err
});
}
if (!result.length) {
return res.status(401).send({
msg: 'Email or password is incorrect!'
});
}
// check password
bcrypt.compare(
req.body.password,
result[0]['password'],
(bErr, bResult) => {
// wrong password
if (bErr) {
throw bErr;
return res.status(401).send({
msg: 'Email or password is incorrect!'
});
}
if (bResult) {
const token = jwt.sign({id_users:result[0]['id_users']},'the-super-strong-secrect',{ expiresIn: '1h' });
db.query(
`UPDATE users SET last_login = now() WHERE id_users = '${result[0]['id_users']}'`
);
return res.status(200).send({
msg: 'Logged in!',
token,
user: result[0]
});
}
return res.status(401).send({
msg: 'Username or password is incorrect!'
});
}
);
}
);
});
router.post('/get-user', signupValidation, (req, res, next) => {
if(
!req.headers.authorization ||
!req.headers.authorization.startsWith('Bearer') ||
!req.headers.authorization.split(' ')[1]
){
return res.status(422).json({
message: "Please provide the token",
});
}
const theToken = req.headers.authorization.split(' ')[1];
const decoded = jwt.verify(theToken, 'the-super-strong-secrect');
//return res.send({ id: theToken });
db.query('SELECT * FROM users where id_users=?', decoded.id_users, function (error, results, fields) {
if (error) throw error;
return res.send({ error: false, data: results[0], message: 'Fetch Successfully.' });
});
});
router.post('/create-user', signupValidation, (req, res, next) => {
    if(
        !req.headers.authorization ||
        !req.headers.authorization.startsWith('Bearer') ||
        !req.headers.authorization.split(' ')[1]
        ){
        return res.status(422).json({
        message: "Please provide the token",
        });
        }

db.query(
`SELECT * FROM users WHERE LOWER(email) = LOWER(${db.escape(
req.body.email
)});`,
(err, result) => {
if (result.length) {
return res.status(409).send({
msg: 'This user is already in use!'
});
} else {
// username is available
bcrypt.hash(req.body.password, 10, (err, hash) => {
if (err) {
return res.status(500).send({
msg: err
});
} else {
// has hashed pw => add to database
db.query(
    `INSERT INTO users (first_name, last_name, email, mobile, password, status, role) VALUES ('${req.body.first_name}', '${req.body.last_name}', ${db.escape(
    req.body.email
    )}, '${req.body.mobile}', ${db.escape(hash)}, '1', 'client')`,
(err, result) => {
if (err) {
throw err;
return res.status(400).send({
msg: err
});
}
return res.status(201).send({
msg: 'The user has been created successfully!'
});
}
);
}
});
}
}
);
});
router.post('/update-user', signupValidation, (req, res, next) => {
    if(
        !req.headers.authorization ||
        !req.headers.authorization.startsWith('Bearer') ||
        !req.headers.authorization.split(' ')[1]
        ){
        return res.status(422).json({
        message: "Please provide the token",
        });
        }  
db.query(
`SELECT * FROM users WHERE LOWER(email) = LOWER(${db.escape(
req.body.email
)}) AND id_users != '${req.body.id_users}';`,
(err, result) => {
if (result.length) {
return res.status(409).send({
msg: 'This user is already in use!'
});
} else {
// username is available
bcrypt.hash(req.body.password, 10, (err, hash) => {
if (err) {
return res.status(500).send({
msg: err
});
} else {
// has hashed pw => add to database
db.query(
`UPDATE users SET first_name ='${req.body.first_name}' , last_name = '${req.body.last_name}', email = ${db.escape(
    req.body.email
    )}, mobile = '${req.body.mobile}', password = ${db.escape(hash)}, status = '${req.body.status}', role = '${req.body.role}' WHERE id_users = '${req.body.id_users}'`,
(err, result) => {
if (err) {
throw err;
return res.status(400).send({
msg: err
});
}
return res.status(201).send({
msg: 'The user has been updated successfully!'
});
}
);
}
});
}
}
);
});
module.exports = router;