const Router = require('koa-router');
const router = new Router();
const face = require('./controller/faceController');

router.get('/',  face.start);

module.exports = router;



