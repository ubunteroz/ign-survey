<?php
    /**
     * Submit Survey Data
     */
    class Survey {
        public static function save($id, $data) {
            $exists = $GLOBALS['database']->has('data', [
                'id' => $id,
                'period' => date('Ym')
            ]);

            if (!$exists) {
                $_data = $data;
                $_data['id'] = $id;
                $_data['period'] = date('Ym');
                $GLOBALS['database']->insert('data', $_data);
            } else {
                $GLOBALS['database']->update('data', $data, ['id' => $id]);
            }
            echo $exists;
        }
    }

?>
