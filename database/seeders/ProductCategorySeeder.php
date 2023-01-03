<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     *  Data reference : https://www.fda.gov/drugs/investigational-new-drug-ind-application/general-drug-categories
     * 
     */
    public function run()
    {
		ProductCategory::insert([
			[
                'name_kh' => "Analgesics",
                'name_en' => "Analgesics",
                'description' => "Drugs that relieve pain. There are two main types: non-narcotic analgesics for mild pain, and narcotic analgesics for severe pain.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antacids",
                'name_en' => "Antacids",
                'description' => "Drugs that relieve indigestion and heartburn by neutralizing stomach acid.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antianxiety Drugs",
                'name_en' => "Antianxiety Drugs",
                'description' => "Drugs that suppress anxiety and relax muscles (sometimes called anxiolytics, sedatives, or minor tranquilizers).",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antiarrhythmics",
                'name_en' => "Antiarrhythmics",
                'description' => "Drugs used to control irregularities of heartbeat.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antibacterials",
                'name_en' => "Antibacterials",
                'description' => "Drugs used to control irregularities of heartbeat.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antibiotics",
                'name_en' => "Antibiotics",
                'description' => "Drugs made from naturally occurring and synthetic substances that combat bacterial infection. Some antibiotics are effective only against limited types of bacteria. Others, known as broad spectrum antibiotics, are effective against a wide range of bacteria.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Anticoagulants and Thrombolytics",
                'name_en' => "Anticoagulants and Thrombolytics",
                'description' => "Anticoagulants prevent blood from clotting. Thrombolytics help dissolve and disperse blood clots and may be prescribed for patients with recent arterial or venous thrombosis.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Anticonvulsants",
                'name_en' => "Anticonvulsants",
                'description' => "Drugs that prevent epileptic seizures.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antidepressants",
                'name_en' => "Antidepressants",
                'description' => "There are three main groups of mood-lifting antidepressants: tricyclics, monoamine oxidase inhibitors, and selective serotonin reuptake inhibitors (SSRIs).",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antidiarrheals",
                'name_en' => "Antidiarrheals",
                'description' => "Drugs used for the relief of diarrhea. Two main types of antidiarrheal preparations are simple adsorbent substances and drugs that slow down the contractions of the bowel muscles so that the contents are propelled more slowly.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antiemetics",
                'name_en' => "Antiemetics",
                'description' => "Drugs used to treat nausea and vomiting.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antifungals",
                'name_en' => "Antifungals",
                'description' => "Drugs used to treat fungal infections, the most common of which affect the hair, skin, nails, or mucous membranes.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antihistamines",
                'name_en' => "Antihistamines",
                'description' => "Drugs used primarily to counteract the effects of histamine, one of the chemicals involved in allergic reactions.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antihypertensives",
                'name_en' => "Antihypertensives",
                'description' => "Drugs that lower blood pressure. The types of antihypertensives currently marketed include diuretics, beta-blockers, calcium channel blocker, ACE (angiotensin- converting enzyme) inhibitors, centrally acting antihypertensives and sympatholytics.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Anti-Inflammatories",
                'name_en' => "Anti-Inflammatories",
                'description' => "Drugs used to reduce inflammation - the redness, heat, swelling, and increased blood flow found in infections and in many chronic noninfective diseases such as rheumatoid arthritis and gout.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antineoplastics",
                'name_en' => "Antineoplastics",
                'description' => "Drugs used to treat cancer.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antipsychotics",
                'name_en' => "Antipsychotics",
                'description' => "Drugs used to treat symptoms of severe psychiatric disorders. These drugs are sometimes called major tranquilizers.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antipyretics",
                'name_en' => "Antipyretics",
                'description' => "Drugs that reduce fever.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Antivirals",
                'name_en' => "Antivirals",
                'description' => "Drugs used to treat viral infections or to provide temporary protection against infections such as influenza.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Barbiturates",
                'name_en' => "Barbiturates",
                'description' => "See sleeping drugs.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Beta-Blockers",
                'name_en' => "Beta-Blockers",
                'description' => "Beta-adrenergic blocking agents, or beta-blockers for short, reduce the oxygen needs of the heart by reducing heartbeat rate.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Bronchodilators",
                'name_en' => "Bronchodilators",
                'description' => "Drugs that open up the bronchial tubes within the lungs when the tubes have become narrowed by muscle spasm. Bronchodilators ease breathing in diseases such as asthma.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Cold Cures",
                'name_en' => "Cold Cures",
                'description' => "Although there is no drug that can cure a cold, the aches, pains, and fever that accompany a cold can be relieved by aspirin or acetaminophen often accompanied by a decongestant, antihistamine, and sometimes caffeine.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Corticosteroids",
                'name_en' => "Corticosteroids",
                'description' => "These hormonal preparations are used primarily as anti-inflammatories in arthritis or asthma or as immunosuppressives, but they are also useful for treating some malignancies or compensating for a deficiency of natural hormones in disorders such as Addison's disease.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Cough Suppressants",
                'name_en' => "Cough Suppressants",
                'description' => "Simple cough medicines, which contain substances such as honey, glycerine, or menthol, soothe throat irritation but do not actually suppress coughing. They are most soothing when taken as lozenges and dissolved in the mouth. As liquids they are probably swallowed too quickly to be effective. A few drugs are actually cough suppressants. There are two groups of cough suppressants: those that alter the consistency or production of phlegm such as mucolytics and expectorants; and those that suppress the coughing reflex such as codeine (narcotic cough suppressants), antihistamines, dextromethorphan and isoproterenol (non-narcotic cough suppressants).",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Cytotoxics",
                'name_en' => "Cytotoxics",
                'description' => "Drugs that kill or damage cells. Cytotoxics are used as antineoplastics (drugs used to treat cancer) and also as immunosuppressives.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Decongestants",
                'name_en' => "Decongestants",
                'description' => "Drugs that reduce swelling of the mucous membranes that line the nose by constricting blood vessels, thus relieving nasal stuffiness.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Diuretics",
                'name_en' => "Diuretics",
                'description' => "Drugs that increase the quantity of urine produced by the kidneys and passed out of the body, thus ridding the body of excess fluid. Diuretics reduce water logging of the tissues caused by fluid retention in disorders of the heart, kidneys, and liver. They are useful in treating mild cases of high blood pressure.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Expectorant",
                'name_en' => "Expectorant",
                'description' => "A drug that stimulates the flow of saliva and promotes coughing to eliminate phlegm from the respiratory tract.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Hormones",
                'name_en' => "Hormones",
                'description' => "Chemicals produced naturally by the endocrine glands (thyroid, adrenal, ovary, testis, pancreas, parathyroid). In some disorders, for example, diabetes mellitus, in which too little of a particular hormone is produced, synthetic equivalents or natural hormone extracts are prescribed to restore the deficiency. Such treatment is known as hormone replacement therapy.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Hypoglycemics (Oral)",
                'name_en' => "Hypoglycemics (Oral)",
                'description' => "Drugs that lower the level of glucose in the blood. Oral hypoglycemic drugs are used in diabetes mellitus if it cannot be controlled by diet alone, but does require treatment with injections of insulin.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Immunosuppressives",
                'name_en' => "Immunosuppressives",
                'description' => "Drugs that prevent or reduce the body's normal reaction to invasion by disease or by foreign tissues. Immunosuppressives are used to treat autoimmune diseases (in which the body's defenses work abnormally and attack its own tissues) and to help prevent rejection of organ transplants.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Laxatives",
                'name_en' => "Laxatives",
                'description' => "Drugs that increase the frequency and ease of bowel movements, either by stimulating the bowel wall (stimulant laxative), by increasing the bulk of bowel contents (bulk laxative), or by lubricating them (stool-softeners, or bowel movement-softeners). Laxatives may be taken by mouth or directly into the lower bowel as suppositories or enemas. If laxatives are taken regularly, the bowels may ultimately become unable to work properly without them.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Muscle Relaxants",
                'name_en' => "Muscle Relaxants",
                'description' => "Drugs that relieve muscle spasm in disorders such as backache. Antianxiety drugs (minor tranquilizers) that also have a muscle-relaxant action are used most commonly.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Sedatives",
                'name_en' => "Sedatives",
                'description' => "Same as Antianxiety drugs.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Sex Hormones (Female)",
                'name_en' => "Sex Hormones (Female)",
                'description' => "There are two groups of these hormones (estrogens and progesterone), which are responsible for development of female secondary sexual characteristics. Small quantities are also produced in males. As drugs, female sex hormones are used to treat menstrual and menopausal disorders and are also used as oral contraceptives. Estrogens may be used to treat cancer of the breast or prostate, progestins (synthetic progesterone to treat endometriosis).",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Sex Hormones (Male)",
                'name_en' => "Sex Hormones (Male)",
                'description' => "Androgenic hormones, of which the most powerful is testosterone, are responsible for development of male secondary sexual characteristics. Small quantities are also produced in females. As drugs, male sex hormones are given to compensate for hormonal deficiency in hypopituitarism or disorders of the testes. They may be used to treat breast cancer in women, but either synthetic derivatives called anabolic steroids, which have less marked side- effects, or specific anti-estrogens are often preferred. Anabolic steroids also have a \"body building\" effect that has led to their (usually nonsanctioned) use in competitive sports, for both men and women.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Sleeping Drugs",
                'name_en' => "Sleeping Drugs",
                'description' => "The two main groups of drugs that are used to induce sleep are benzodiazepines and barbiturates. All such drugs have a sedative effect in low doses and are effective sleeping medications in higher doses. Benzodiazepines drugs are used more widely than barbiturates because they are safer, the side-effects are less marked, and there is less risk of eventual physical dependence.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Tranquilizer",
                'name_en' => "Tranquilizer",
                'description' => "This is a term commonly used to describe any drug that has a calming or sedative effect. However, the drugs that are sometimes called minor tranquilizers should be called antianxiety drugs, and the drugs that are sometimes called major tranquilizers should be called antipsychotics.",
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name_kh' => "Vitamins",
                'name_en' => "Vitamins",
                'description' => "Chemicals essential in small quantities for good health. Some vitamins are not manufactured by the body, but adequate quantities are present in a normal diet. People whose diets are inadequate or who have digestive tract or liver disorders may need to take supplementary vitamins.",
                'status' => 1,
                'user_id' => 1,
            ]
        ]);
            


        ProductCategory::insert([
			[
				'name_kh' => 'Liquid',
				'name_en' => 'Liquid',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Tablet',
				'name_en' => 'Tablet',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Capsules',
				'name_en' => 'Capsules',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Topical medicines',
				'name_en' => 'Topical medicines',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Suppositories',
				'name_en' => 'Suppositories',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Drops',
				'name_en' => 'Drops',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Inhalers',
				'name_en' => 'Inhalers',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Injections',
				'name_en' => 'Injections',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Implants or patches',
				'name_en' => 'Implants or patches',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
		]);
    }
}
