<?php

namespace EducationCalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalendarController extends Controller
{
    public function selectAction()
    {
        return $this->render('EducationCalendarBundle:Calendar:selectclass.html.php');
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
                    ]
                ]
            ]
        ];
        return $this->render('EducationCalendarBundle:Calendar:calendar.html.php',array('datas' => $datas));
    }
}
