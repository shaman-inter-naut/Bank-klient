        $sums = (object) [$fi20208, $fi20210, $fi20214];
        $i = 0;
        foreach ($sums as $key => $value) {
            foreach ($value as $ke => $valu) {
                $company_unikal = substr($valu->company_account, 9, 8);
                echo $company_unikal." -> sum = ";
                $document = Document::find()->where(['company_unikal' => $company_unikal])->all();
                $summ = 0;
                foreach ($document as $k => $val) {
                    $summ += $val->detail_kredit;
                    echo $val->detail_kredit;
                }
                $sum[$i++] = $summ;
                // $sum['all'] += $sum[$company_unikal];
                echo $sum[$company_unikal];
                echo '<hr><hr>';

            }

        }

        print_r($sum);