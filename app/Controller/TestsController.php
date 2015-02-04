 <?php 
 App::uses('AppController', 'Controller');
class TestsController extends AppController
{
    var $components = array('RequestHandler');
    var $helpers = array('Html','Form','Javascript');
    var $paginate = array('order'=>array('Image.title'),'limit'=>'15');

        function lists()
        {
                $data = $this->paginate();
                $this->set('images',$data);
        }

}
?> 