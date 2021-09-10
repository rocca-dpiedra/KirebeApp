<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Timelogs Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ProjectsTable&\Cake\ORM\Association\BelongsTo $Projects
 *
 * @method \App\Model\Entity\Timelog newEmptyEntity()
 * @method \App\Model\Entity\Timelog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Timelog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Timelog get($primaryKey, $options = [])
 * @method \App\Model\Entity\Timelog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Timelog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Timelog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Timelog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timelog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timelog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Timelog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Timelog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Timelog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TimelogsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('timelogs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmptyDateTime('date');

        $validator
            ->boolean('status')
            ->notEmptyString('status');

        $validator
            ->time('starttime')
            ->requirePresence('starttime', 'create')
            ->notEmptyTime('starttime');

        $validator
            ->time('endtime')
            ->allowEmptyTime('endtime');

        $validator
            ->time('elapsedtime')
            ->allowEmptyTime('elapsedtime');

        $validator
            ->decimal('cost')
            ->allowEmptyString('cost');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['project_id'], 'Projects'), ['errorField' => 'project_id']);

        return $rules;
    }

    
    //Comentario Darío ***********************************************************
    /**
     * Se agrega un método que busca las sesiones abiertas del usuario que está activo.
     * Esto funciona como una bandera qué permite "controlar" qué un usuario tenga dos sesiones abiertas.
    */
    public function activeLog( $user)
    {
        $activo = $this->find()->where(['status' => 1, 'user_id' => $user])->count();
        return $activo;
    }

    public function registro($user)
    {
        $registro = $this->find()->where(['status' => 1, 'user_id' => $user])->first();
        return $registro;
    }

    public function estado($id)
    {
        $estado = $this->find()->select(['status'])->where(['id' => $id])->first();
        return $estado;
    }



    public function projectRes(){
        $resumen = $this->find('all')->innerJoinWith('Projects');
        $resumen->select(
            [
                'project_id',
                'nombre' => 'Projects.name', 
                "sesiones" => $resumen->func()->COUNT('timelogs.id'),
                'init' => 'MIN(date)',
                'end' => 'MAX(date)',
                'total' => 'SEC_TO_TIME(SUM(TIME_TO_SEC(elapsedtime)))', 
                'monto' => 'ROUND(SUM(cost))'
            ]
        )
        ->group('timelogs.project_id');
        return $resumen;
    }


    public function userRes(){
        $resumen = $this->find('all')->innerJoinWith('Users');
        $resumen->select(
            [
                'user_id',
                'nombre' => 'Users.fullname',
                "sesiones" => $resumen->func()->COUNT('timelogs.id'),
                'init' => 'MIN(date)',
                'end' => 'MAX(date)',
                'total' => 'SEC_TO_TIME(SUM(TIME_TO_SEC(elapsedtime)))', 
                'monto' => 'ROUND(SUM(cost))'
            ]
        )
        ->group('timelogs.user_id');
        return $resumen;
    }

    public function reportDetail(){
        $resumen = $this->find('all')->innerJoinWith('Users');
        $resumen->innerJoinWith('Projects');
        $resumen->select(
            [
                'user_id',
                'project_id',
                'id' => 'timelogs.id',
                'usuario' => 'Users.fullname',
                'proyecto' => 'Projects.name',
                'date' => 'timelogs.date',
                'inicia' => 'timelogs.starttime',
                'termina' => 'timelogs.endtime',
                'time' => 'timelogs.elapsedtime',
                'monto' => 'timelogs.cost'

            ]
        );
        return $resumen;
    }

    public function activeList(){
        $consulta = $this->find('all')->innerJoinWith('Users');
        $consulta->innerJoinWith('Projects');
        $consulta->select(
            [
                'id' => 'timelogs.id',
                'usuario' => 'Users.fullname',
                'proyecto' => 'Projects.name',
                'date' => 'timelogs.date',
                'inicia' => 'timelogs.starttime',
            ]
        );
        $consulta->where(['timelogs.status' => 1]);

        return $consulta;
    }

    public function personalizado(){
        $resumen = $this->find('all')->innerJoinWith('Users');
        $resumen->innerJoinWith('Projects');
        $resumen->select(
            [
                'id' => 'timelogs.id',
                'usuario' => 'Users.fullname',
                'proyecto' => 'Projects.name',
                'date' => 'timelogs.date',
                'inicia' => 'timelogs.starttime',
                'termina' => 'timelogs.endtime',
                'time' => 'timelogs.elapsedtime',
                'monto' => 'timelogs.cost'
            ]
        );
        return $resumen;
    }
}
