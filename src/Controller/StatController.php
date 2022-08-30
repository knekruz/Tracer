<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Service\CallApiService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class StatController extends AbstractController
{
    #[Route('/stat/{idTaux}', name: 'app_stat', methods: ['GET'])]
    public function showFactureSupport(EntityManagerInterface $em)
    {
        $conn = $em
            ->getConnection();

            $sql = 'SELECT support_id, isin, nom, date_premier_investist, montant_invest, montant_moyen, duree_jours,
            support_taux_id, taux, debut_commerce, fin_commerce,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours, 2) as frais_client,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours * taux_emetteur / 100, 2) as frais_emetteur,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours * (1 - taux_emetteur / 100), 2) reste_emetteur,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours * (1 - taux_emetteur / 100) * taux_mfex / 100, 2) as frais_mfex,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours * (1 - taux_emetteur / 100) * (1 - taux_mfex / 100), 2) as reste_mfex,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours * (1 - taux_emetteur / 100) * (1 - taux_mfex / 100) * taux_cnp / 100, 2) as frais_cnp,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours * (1 - taux_emetteur / 100) * (1 - taux_mfex / 100) * taux_dist / 100, 2) as frais_distributeur,
            type_de_frais, statut, taux_emetteur, taux_mfex, taux_cnp, taux_dist
            FROM
                (SELECT *,
                TIMESTAMPDIFF(DAY, debut_commerce, fin_commerce) + 1 as duree_jours,
                ROUND(SUM(montant_moyen_invest),2) as montant_moyen
                FROM
                (SELECT  s.id as support_id,  s.isin, s.nom, s.date_premier_investist, s.montant_invest,
                    st.id as support_taux_id, st.taux, st.taux_mfex as taux_mfex, st.taux_cnp as taux_cnp, st.taux_distributeur as taux_dist,
                    st.debut_commerce, st.fin_commerce,t.nom as type_de_frais, st.status as statut, st.taux_emetteur as taux_emetteur,
            AVG(si.montant_net) AS montant_moyen_invest
                    FROM support s, support_taux st, support_investissement si, schemasdata sch, type_frais t, support_schema ss
                    WHERE st.id_support_id = s.id AND si.id_support_id = s.id
                 	AND s.id=ss.support_id and ss.schema_id = sch.id and sch.type_frais_id=t.id
                    AND si.date_pos BETWEEN st.debut_commerce and st.fin_commerce
                    GROUP BY st.id, si.id_invest) encours_par_invest
                GROUP BY  encours_par_invest.support_taux_id) encours_moyen
                ORDER BY statut ASC';
            $stmt = $conn->prepare($sql);
            $result = $stmt->executeQuery();
            $stats = $result->fetchAll();
            //print_r($result->fetchAll());die;
            
         return $this->render('facturation/stat.html.twig', [
            'stats' => $stats,
        ]);
    }
    #[Route('/facturation', name: 'app_facturation', methods: ['GET'])]
    public function showFacturation(EntityManagerInterface $em)
    {
        $conn = $em
            ->getConnection();

            $sql = 'SELECT support_id, isin, nom, date_premier_investist, montant_invest, montant_moyen, duree_jours,
            support_taux_id, taux, debut_commerce, fin_commerce,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours, 2) as frais_client,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours * taux_emetteur / 100, 2) as frais_emetteur,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours * (1 - taux_emetteur / 100), 2) reste_emetteur,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours * (1 - taux_emetteur / 100) * taux_cnp / 100, 2) as frais_cnp,
            ROUND(montant_moyen * taux / 100 / 365 * duree_jours * (1 - taux_emetteur / 100) * taux_distributeur / 100, 2) as frais_distributeur,
            type_de_frais, statut
            FROM
                (SELECT *,
                TIMESTAMPDIFF(DAY, debut_commerce, fin_commerce) + 1 as duree_jours,
                ROUND(SUM(montant_moyen_invest),2) as montant_moyen
                FROM
                (SELECT  s.id as support_id,  s.isin, s.nom, s.date_premier_investist, s.montant_invest,
                    st.id as support_taux_id, st.taux, st.taux_emetteur, st.taux_cnp, st.taux_distributeur,
                    st.debut_commerce, st.fin_commerce,t.nom as type_de_frais, st.status as statut,
            AVG(si.montant_net) AS montant_moyen_invest
                    FROM support s, support_taux st, support_investissement si, schemasdata sch, type_frais t, support_schema ss
                    WHERE st.id_support_id = s.id AND si.id_support_id = s.id
                 	AND s.id=ss.support_id and ss.schema_id = sch.id and sch.type_frais_id=t.id
                    AND si.date_pos BETWEEN st.debut_commerce and st.fin_commerce
                    GROUP BY st.id, si.id_invest) encours_par_invest
                GROUP BY  encours_par_invest.support_taux_id) encours_moyen
                ORDER BY statut ASC';
            $stmt = $conn->prepare($sql);
            $result = $stmt->executeQuery();
            $stats = $result->fetchAll();
            //print_r($result->fetchAll());die;
            
         return $this->render('facturation/facturation.html.twig', [
            'stats' => $stats,
        ]);
    }
}
