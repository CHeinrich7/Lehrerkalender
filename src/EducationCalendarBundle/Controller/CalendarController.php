<?php

namespace EducationCalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalendarController extends Controller
{
    public function selectAction()
    {
        $em = $this->get('doctrine.orm.default_entity_manager');

        $subjectEntities = $em->getRepository('SubjectBundle:SubjectEntity')->findAll();
        $classEntities = $em->getRepository('SubjectBundle:EducationClassEntity')->findAll();

        return $this->render('EducationCalendarBundle:Calendar:selectClass.html.php', array('subjectEntities' => $subjectEntities, 'classEntities' => $classEntities));
    }
    public function calendarAction()
    {
        $datas = [
            [
                'title' => 'Montag',
                'content' => [
                    [
                        'stunde' => '1',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '2',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '3',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '4',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '5',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '6',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '7',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '8',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '9',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '10',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ]
                ]
            ], [
                'title' => 'Dienstag',
                'content' => [
                    [
                        'stunde' => '1',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '2',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '3',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '4',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '5',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '6',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '7',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '8',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '9',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '10',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ]
                ]
            ], [
                'title' => 'Mittwoch',
                'content' => [
                    [
                        'stunde' => '1',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '2',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '3',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '4',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '5',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '6',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '7',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '8',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '9',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '10',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ]
                ]
            ], [
                'title' => 'Donnerstag',
                'content' => [
                    [
                        'stunde' => '1',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '2',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '3',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '4',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '5',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '6',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '7',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '8',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '9',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '10',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ]
                ]
            ], [
                'title' => 'Freitag',
                'content' => [
                    [
                        'stunde' => '1',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '2',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '3',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '4',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '5',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '6',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '7',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '8',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '9',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '10',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ]
                ]
            ], [
                'title' => 'Samstag',
                'content' => [
                    [
                        'stunde' => '1',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '2',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '3',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '4',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '5',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '6',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '7',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '8',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '9',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '10',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ]
                ]
            ], [
                'title' => 'Sonntag',
                'content' => [
                    [
                        'stunde' => '1',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '2',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '3',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '4',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '5',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '6',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '7',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '8',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '9',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ],
                    [
                        'stunde' => '10',
                        'raum' => '',
                        'klasse' => '',
                        'fach' => '',
                        'inhalt' => '',
                        'notiz' => ''
                    ]
                ]
            ]
        ];
        return $this->render('EducationCalendarBundle:Calendar:calendar.html.php',array('datas' => $datas));
    }
}
