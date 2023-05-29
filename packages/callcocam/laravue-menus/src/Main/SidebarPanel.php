<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Menus\Main;


class SidebarPanel
{
    public static function elements()
    {
        return [
            'title' => 'Elements',
            'icon' => 'fa-cubes',
            'path_name' => 'elements',
            'items' => [
                [
                    'elements_avatar' => [
                        'title' => 'Avatar',
                        'route_name' => [
                            'name' => 'elements.avatar.index'
                        ],
                        'path_name' => '/avatar',
                        'key' => 'elements/avatar',
                        'name' => 'elements.avatar.index',
                        'crud'=>false
                    ],
                    'elements_alert' => [
                        'title' => 'Alert',
                        'route_name' => [
                            'name' => 'elements.alert.index'
                        ],
                        'path_name' => '/alert',
                        'key' => 'elements/alert',
                        'name' => 'elements.alert.index',
                        'crud'=>false
                    ],
                    'elements_button' => [
                        'title' => 'Button',
                        'route_name' => [
                            'name' => 'elements.button.index'
                        ],
                        'path_name' => '/button',
                        'key' => 'elements/button',
                        'name' => 'elements.button.index',
                        'crud'=>false
                    ],
                    'elements_button_group' => [
                        'title' => 'Button Group',
                        'route_name' => [
                            'name' => 'elements.button-group.index'
                        ],
                        'path_name' => '/button-group',
                        'key' => 'elements/button-group',
                        'name' => 'elements.button-group.index',
                        'crud'=>false
                    ],
                    'elements_badge' => [
                        'title' => 'Badge',
                        'route_name' => [
                            'name' => 'elements.badge.index'
                        ],
                        'path_name' => '/badge',
                        'key' => 'elements/badge',
                        'name' => 'elements.badge.index',
                        'crud'=>false
                    ],
                    'elements_breadcrumb' => [
                        'title' => 'Breadcrumb',
                        'route_name' => [
                            'name' => 'elements.breadcrumb.index'
                        ],
                        'path_name' => '/breadcrumb',
                        'key' => 'elements/breadcrumb',
                        'name' => 'elements.breadcrumb.index',
                        'crud'=>false
                    ],
                    'elements_card' => [
                        'title' => 'Card',
                        'route_name' => [
                            'name' => 'elements.card.index'
                        ],
                        'path_name' => '/card',
                        'key' => 'elements/card',
                        'name' => 'elements.card.index',
                        'crud'=>false
                    ],
                    'elements_divider' => [
                        'title' => 'Divider',
                        'route_name' => [
                            'name' => 'elements.divide.indexr'
                        ],
                        'path_name' => '/divider',
                        'key' => 'elements/divider',
                        'name' => 'elements.divider.index',
                        'crud'=>false
                    ],
                    'elements_mask' => [
                        'title' => 'Mask',
                        'route_name' => [
                            'name' => 'elements.mask.index'
                        ],
                        'path_name' => '/mask',
                        'key' => 'elements/mask',
                        'name' => 'elements.mask.index',
                        'crud'=>false
                    ],
                    'elements_progress' => [
                        'title' => 'Progress',
                        'route_name' => [
                            'name' => 'elements.progress.index'
                        ],
                        'path_name' => '/progress',
                        'key' => 'elements/progress',
                        'name' => 'elements.progress.index',
                        'crud'=>false
                    ],
                    'elements_skeleton' => [
                        'title' => 'Skeleton',
                        'route_name' => [
                            'name' => 'elements.skeleton.index'
                        ],
                        'path_name' => '/skeleton',
                        'key' => 'elements/skeleton',
                        'name' => 'elements.skeleton.index',
                        'crud'=>false
                    ],
                    'elements_spinner' => [
                        'title' => 'Spinner',
                        'route_name' => [
                            'name' => 'elements.spinner.index'
                        ],
                        'path_name' => '/spinner',
                        'key' => 'elements/spinner',
                        'name' => 'elements.spinner.index',
                        'crud'=>false
                    ],
                    'elements_tag' => [
                        'title' => 'Tag',
                        'route_name' => [
                            'name' => 'elements.tag.index'
                        ],
                        'path_name' => '/tag',
                        'key' => 'elements/tag',
                        'name' => 'elements.tag.index',
                        'crud'=>false
                    ],
                    'elements_tooltip' => [
                        'title' => 'Tooltip',
                        'route_name' => [
                            'name' => 'elements.tooltip.index'
                        ],
                        'path_name' => '/tooltip',
                        'key' => 'elements/tooltip',
                        'name' => 'elements.tooltip.index',
                        'crud'=>false
                    ],
                ],
                [
                    'elements_forms' => [
                        'title' => 'Forms',
                        'route_name' => [
                            'name' => 'forms.input-text.index'
                        ],
                        'path_name' => '/input-text',
                        'key' => 'forms/input-text',
                        'name' => 'forms.input-text.index',
                        'crud'=>false
                    ],
                    'elements_typography' => [
                        'title' => 'Typography',
                        'route_name' => [
                            'name' => 'elements.typography.index'
                        ],
                        'path_name' => '/typography',
                        'key' => 'elements/typography',
                        'name' => 'elements.typography.index',
                        'crud'=>false
                    ],
                ]
            ]
        ];
    }

    public static function components()
    {
        return [
            'title' => 'Components',
            'icon' => 'fa-archive',
            'path_name' => 'components',
            'items' => [
                [
                    'components_accordion' => [
                        'title' => 'Accordion',
                        'route_name' => [
                            'name' => 'components.accordion.index'
                        ],
                        'path_name' => '/accordion',
                        'key' => 'components/accordion',
                        'name' => 'components.accordion.index',
                        'crud'=>false
                    ],
                    'components_collapse' => [
                        'title' => 'Collapse',
                        'route_name' => [
                            'name' => 'components.collapse.index'
                        ],
                        'path_name' => '/collapse',
                        'key' => 'components/collapse',
                        'name' => 'components.collapse.index',
                        'crud'=>false
                    ],
                    'components_tab' => [
                        'title' => 'Tab',
                        'route_name' => [
                            'name' => 'components.tab.index'
                        ],
                        'path_name' => '/tab',
                        'key' => 'components/tab',
                        'name' => 'components.tab.index',
                        'crud'=>false
                    ],
                    'components_dropdown' => [
                        'title' => 'Dropdown',
                        'route_name' => [
                            'name' => 'components.dropdown.index'
                        ],
                        'path_name' => '/dropdown',
                        'key' => 'components/dropdown',
                        'name' => 'components.dropdown.index',
                        'crud'=>false
                    ],
                    'components_popover' => [
                        'title' => 'Popover',
                        'route_name' => [
                            'name' => 'components.popover.index'
                        ],
                        'path_name' => '/popover',
                        'key' => 'components/popover',
                        'name' => 'components.popover.index',
                        'crud'=>false
                    ],
                    'components_modal' => [
                        'title' => 'Modal',
                        'route_name' => [
                            'name' => 'components.modal.index'
                        ],
                        'path_name' => '/modal',
                        'key' => 'components/modal',
                        'name' => 'components.modal.index',
                        'crud'=>false
                    ],
                    'components_drawer' => [
                        'title' => 'Drawer',
                        'route_name' => [
                            'name' => 'components.drawer.index'
                        ],
                        'path_name' => '/drawer',
                        'key' => 'components/drawer',
                        'name' => 'components.drawer.index',
                        'crud'=>false
                    ],
                    'components_steps' => [
                        'title' => 'Steps',
                        'route_name' => [
                            'name' => 'components.steps.index'
                        ],
                        'path_name' => '/steps',
                        'key' => 'components/steps',
                        'name' => 'components.steps.index',
                        'crud'=>false
                    ],
                    'components_timeline' => [
                        'title' => 'Timeline',
                        'route_name' => [
                            'name' => 'components.timeline.index'
                        ],
                        'path_name' => '/timeline',
                        'key' => 'components/timeline',
                        'name' => 'components.timeline.index',
                        'crud'=>false
                    ],
                    'components_pagination' => [
                        'title' => 'Pagination',
                        'route_name' => [
                            'name' => 'components.pagination.index'
                        ],
                        'path_name' => '/pagination',
                        'key' => 'components/pagination',
                        'name' => 'components.pagination.index',
                        'crud'=>false
                    ],
                    'components_menu_list' => [
                        'title' => 'Menu List',
                        'route_name' => [
                            'name' => 'components.menu-list.index'
                        ],
                        'path_name' => '/menu-list',
                        'key' => 'components/menu-list',
                        'name' => 'components.menu-list.index',
                        'crud'=>false
                    ],
                    'components_treeview' => [
                        'title' => 'Treeview',
                        'route_name' => [
                            'name' => 'components.treeview.index'
                        ],
                        'path_name' => '/treeview',
                        'key' => 'components/treeview',
                        'name' => 'components.treeview.index',
                        'crud'=>false
                    ],

                ],
                [
                    'components_table' => [
                        'title' => 'Table',
                        'route_name' => [
                            'name' => 'components.table.index'
                        ],
                        'path_name' => '/table',
                        'key' => 'components/table',
                        'name' => 'components.table.index',
                        'crud'=>false
                    ],

                    'components_table_advanced' => [
                        'title' => 'Table Advanced',
                        'route_name' => [
                            'name' => 'components.table-advanced.index'
                        ],
                        'path_name' => '/table-advanced',
                        'key' => 'components/table-advanced',
                        'name' => 'components.table-advanced.index',
                        'crud'=>false
                    ],

                    'components_table_gridjs' => [
                        'title' => 'Table Gridjs',
                        'route_name' => [
                            'name' => 'components.gridjs.index'
                        ],
                        'path_name' => '/gridjs',
                        'key' => 'components/gridjs',
                        'name' => 'components.gridjs.index',
                        'crud'=>false
                    ],
                ],
                [
                    'components_apexchart' => [
                        'title' => 'Apexcharts',
                        'route_name' => [
                            'name' => 'components.apexchart.index'
                        ],
                        'path_name' => '/apexchart',
                        'key' => 'components/apexchart',
                        'name' => 'components.apexchart.index',
                        'crud'=>false
                    ],

                    'components_carousel' => [
                        'title' => 'Carousel',
                        'route_name' => [
                            'name' => 'components.carousel.index'
                        ],
                        'path_name' => '/carousel',
                        'key' => 'components/carousel',
                        'name' => 'components.carousel.index',
                        'crud'=>false
                    ],

                    'components_notification' => [
                        'title' => 'Notification',
                        'route_name' => [
                            'name' => 'components.notification.index'
                        ],
                        'path_name' => '/notification',
                        'key' => 'components/notification',
                        'name' => 'components.notification.index',
                        'crud'=>false
                    ],
                ],
                [
                    'components_extension_clipboard' => [
                        'title' => 'Clipboard',
                        'route_name' => [
                            'name' => 'components.extension-clipboard.index'
                        ],
                        'path_name' => '/extension-clipboard',
                        'key' => 'components/extension-clipboard',
                        'name' => 'components.extension-clipboard.index',
                        'crud'=>false
                    ],
                    'components_extension_persist' => [
                        'title' => 'Persist',
                        'route_name' => [
                            'name' => 'components.extension-persist.index'
                        ],
                        'path_name' => '/extension-persist',
                        'key' => 'components/extension-persist',
                        'name' => 'components.extension-persist.index',
                        'crud'=>false
                    ],
                    'components_extension_monochrome' => [
                        'title' => 'Monochrome Mode',
                        'route_name' => [
                            'name' => 'components.extension-monochrome.index'
                        ],
                        'path_name' => '/extension-monochrome',
                        'key' => 'components/extension-monochrome',
                        'name' => 'components.extension-monochrome.index',
                        'crud'=>false
                    ],
                ],
            ]
        ];
    }

    public static function forms()
    {
        return [
            'title' => 'Forms',
            'icon' => 'fa-wpforms',
            'path_name' => 'forms',
            'items' => [
                [
                    'forms_layout_v1' => [
                        'title' => 'Form Layout v1',
                        'route_name' => [
                            'name' => 'forms.layout-v1.index'
                        ],
                        'path_name' => '/layout-v1',
                        'key' => 'forms/layout-v1',
                        'name' => 'forms.layout-v1.index',
                        'crud'=>false
                    ],
                    'forms_layout_v2' => [
                        'title' => 'Form Layout v2',
                        'route_name' => [
                            'name' => 'forms.layout-v2.index'
                        ],
                        'path_name' => '/layout-v2',
                        'key' => 'forms/layout-v2',
                        'name' => 'forms.layout-v2.index',
                        'crud'=>false
                    ],
                    'forms_layout_v3' => [
                        'title' => 'Form Layout v3',
                        'route_name' => [
                            'name' => 'forms.layout-v3.index'
                        ],
                        'path_name' => '/layout-v3',
                        'key' => 'forms/layout-v3',
                        'name' => 'forms.layout-v3.index',
                        'crud'=>false
                    ],
                    'forms_layout_v4' => [
                        'title' => 'Form Layout v4',
                        'route_name' => [
                            'name' => 'forms.layout-v4.index'
                        ],
                        'path_name' => '/layout-v4',
                        'key' => 'forms/layout-v4',
                        'name' => 'forms.layout-v4.index',
                        'crud'=>false
                    ],
                    'forms_layout_v5' => [
                        'title' => 'Form Layout v5',
                        'route_name' => [
                            'name' => 'forms.layout-v5.index'
                        ],
                        'path_name' => '/layout-v5',
                        'key' => 'forms/layout-v5',
                        'name' => 'forms.layout-v5.index',
                        'crud'=>false
                    ],
                ],
                [
                    'forms_input_text' => [
                        'title' => 'Input text',
                        'route_name' => [
                            'name' => 'forms.input-text.index'
                        ],
                        'path_name' => '/input-text',
                        'key' => 'forms/input-text',
                        'name' => 'forms.input-text.index',
                        'crud'=>false
                    ],
                    'forms_input_group' => [
                        'title' => 'Input group',
                        'route_name' => [
                            'name' => 'forms.input-group.index'
                        ],
                        'path_name' => '/input-group',
                        'key' => 'forms/input-group',
                        'name' => 'forms.input-group.index',
                        'crud'=>false
                    ],
                    'forms_input_mask' => [
                        'title' => 'Input mask',
                        'route_name' => [
                            'name' => 'forms.input-mask.index'
                        ],
                        'path_name' => '/input-mask',
                        'key' => 'forms/input-mask',
                        'name' => 'forms.input-mask.index',
                        'crud'=>false
                    ],
                    'forms_checkbox' => [
                        'title' => 'Checkbox',
                        'route_name' => [
                            'name' => 'forms.checkbox.index'
                        ],
                        'path_name' => '/checkbox',
                        'key' => 'forms/checkbox',
                        'name' => 'forms.checkbox.index',
                        'crud'=>false
                    ],
                    'forms_radio' => [
                        'title' => 'Radio',
                        'route_name' => [
                            'name' => 'forms.radio.index'
                        ],
                        'path_name' => '/radio',
                        'key' => 'forms/radio',
                        'name' => 'forms.radio.index',
                        'crud'=>false
                    ],
                    'forms_switch' => [
                        'title' => 'Switch',
                        'route_name' => [
                            'name' => 'forms.switch.index'
                        ],
                        'path_name' => '/switch',
                        'key' => 'forms/switch',
                        'name' => 'forms.switch.index',
                        'crud'=>false
                    ],
                    'forms_select' => [
                        'title' => 'Select',
                        'route_name' => [
                            'name' => 'forms.select.index'
                        ],
                        'path_name' => '/select',
                        'key' => 'forms/select',
                        'name' => 'forms.select.index',
                        'crud'=>false
                    ],
                    'forms_tom_select' => [
                        'title' => 'Tom select',
                        'route_name' => [
                            'name' => 'forms.tom-select.index'
                        ],
                        'path_name' => '/tom-select',
                        'key' => 'forms/tom-select',
                        'name' => 'forms.tom-select.index',
                        'crud'=>false
                    ],
                    'forms_textarea' => [
                        'title' => 'Textarea',
                        'route_name' => [
                            'name' => 'forms.textarea.index'
                        ],
                        'path_name' => '/textarea',
                        'key' => 'forms/textarea',
                        'name' => 'forms.textarea.index',
                        'crud'=>false
                    ],
                    'forms_range' => [
                        'title' => 'Range',
                        'route_name' => [
                            'name' => 'forms.range.index'
                        ],
                        'path_name' => '/range',
                        'key' => 'forms/range',
                        'name' => 'forms.range.index',
                        'crud'=>false
                    ],
                    'forms_datepicker' => [
                        'title' => 'Datepicker',
                        'route_name' => [
                            'name' => 'forms.datepicker.index'
                        ],
                        'path_name' => '/datepicker',
                        'key' => 'forms/datepicker',
                        'name' => 'forms.datepicker.index',
                        'crud'=>false
                    ],
                    'forms_timepicker' => [
                        'title' => 'Timepicker',
                        'route_name' => [
                            'name' => 'forms.timepicker.index'
                        ],
                        'path_name' => '/timepicker',
                        'key' => 'forms/timepicker',
                        'name' => 'forms.timepicker.index',
                        'crud'=>false
                    ],
                    'forms_datetimepicker' => [
                        'title' => 'Datetimepicker',
                        'route_name' => [
                            'name' => 'forms.datetimepicker.index'
                        ],
                        'path_name' => '/datetimepicker',
                        'key' => 'forms/datetimepicker',
                        'name' => 'forms.datetimepicker.index',
                        'crud'=>false
                    ],
                    'forms_text_editor' => [
                        'title' => 'Text editor',
                        'route_name' => [
                            'name' => 'forms.text-editor.index'
                        ],
                        'path_name' => '/text-editor',
                        'key' => 'forms/text-editor',
                        'name' => 'forms.text-editor.index',
                        'crud'=>false
                    ],
                    'forms_upload' => [
                        'title' => 'Form upload',
                        'route_name' => [
                            'name' => 'forms.upload.index'
                        ],
                        'path_name' => '/upload',
                        'key' => 'forms/upload',
                        'name' => 'forms.upload.index',
                        'crud'=>false
                    ],
                    'forms_validation' => [
                        'title' => 'Form Validation',
                        'route_name' => [
                            'name' => 'forms.validation.index'
                        ],
                        'path_name' => '/validation',
                        'key' => 'forms/validation',
                        'name' => 'forms.validation.index',
                        'crud'=>false
                    ],
                ]
            ]
        ];
    }

    public static function layouts()
    {
        return [
            'title' => 'Layouts',
            'icon' => 'fa-swatchbook',
            'path_name' => 'layouts',
            'items' => [
                [
                    'layouts_onboarding' => [
                        'title' => 'Onboarding',
                        'path_name' => 'layouts',
                        'submenu' => [
                            'layouts_onboarding_1' => [
                                'title' => 'Onboarding 1',
                                'route_name' => [
                                    'name' => 'layouts.onboarding-1.index'
                                ],
                                'path_name' => 'onboarding-1',
                                'key' => 'layouts/onboarding-1',
                                'name' => 'layouts.onboarding-1.index',
                                'crud'=>false
                            ],
                            'layouts_onboarding_2' => [
                                'title' => 'Onboarding 2',
                                'route_name' => [
                                    'name' => 'layouts.onboarding-2.index'
                                ],
                                'path_name' => 'onboarding-2',
                                'key' => 'layouts/onboarding-2',
                                'name' => 'layouts.onboarding-2.index',
                                'crud'=>false
                            ]
                        ]
                    ],
                    'layouts_user_card' => [
                        'title' => 'User Card',
                        'path_name' => 'layouts',
                        'submenu' => [
                            'layouts_user_card_1' => [
                                'title' => 'User Card 1',
                                'route_name' => [
                                    'name' => 'layouts.user-card-1.index'
                                ],
                                'path_name' => 'user-card-1',
                                'key' => 'layouts/user-card-1',
                                'name' => 'layouts.user-card-1.index',
                                'crud'=>false
                            ],
                            'layouts_user_card_2' => [
                                'title' => 'User Card 2',
                                'route_name' => [
                                    'name' => 'layouts.user-card-2.index'
                                ],
                                'path_name' => 'user-card-2',
                                'key' => 'layouts/user-card-2',
                                'name' => 'layouts.user-card-2.index',
                                'crud'=>false
                            ],
                            'layouts_user_card_3' => [
                                'title' => 'User Card 3',
                                'route_name' => [
                                    'name' => 'layouts.user-card-3.index'
                                ],
                                'path_name' => 'user-card-3',
                                'key' => 'layouts/user-card-3',
                                'name' => 'layouts.user-card-3.index',
                                'crud'=>false
                            ],
                            'layouts_user_card_4' => [
                                'title' => 'User Card 4',
                                'route_name' => [
                                    'name' => 'layouts.user-card-4.index'
                                ],
                                'path_name' => 'user-card-4',
                                'key' => 'layouts/user-card-4',
                                'name' => 'layouts.user-card-4.index',
                                'crud'=>false
                            ],
                            'layouts_user_card_5' => [
                                'title' => 'User Card 5',
                                'route_name' => [
                                    'name' => 'layouts.user-card-5.index'
                                ],
                                'path_name' => 'user-card-5',
                                'key' => 'layouts/user-card-5',
                                'name' => 'layouts.user-card-5.index',
                                'crud'=>false
                            ],
                            'layouts_user_card_6' => [
                                'title' => 'User Card 6',
                                'route_name' => [
                                    'name' => 'layouts.user-card-6.index'
                                ],
                                'path_name' => 'user-card-6',
                                'key' => 'layouts/user-card-6',
                                'name' => 'layouts.user-card-6.index',
                                'crud'=>false
                            ],
                            'layouts_user_card_7' => [
                                'title' => 'User Card 7',
                                'route_name' => [
                                    'name' => 'layouts.user-card-7.index'
                                ],
                                'path_name' => 'user-card-7',
                                'key' => 'layouts/user-card-7',
                                'name' => 'layouts.user-card-7.index',
                                'crud'=>false
                            ],
                        ]
                    ],
                    'layouts_blog_card' => [
                        'title' => 'Blog Card',
                        'path_name' => 'layouts',
                        'submenu' => [
                            'layouts_blog_card_1' => [
                                'title' => 'Blog Card 1',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-1.index'
                                ],
                                'path_name' => 'blog-card-1',
                                'key' => 'layouts/blog-card-1',
                                'name' => 'layouts.blog-card-1.index',
                                'crud'=>false
                            ],
                            'layouts_blog_card_2' => [
                                'title' => 'Blog Card 2',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-2.index'
                                ],
                                'path_name' => 'blog-card-2',
                                'key' => 'layouts/blog-card-2',
                                'name' => 'layouts.blog-card-2.index',
                                'crud'=>false
                            ],
                            'layouts_blog_card_3' => [
                                'title' => 'Blog Card 3',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-3.index'
                                ],
                                'path_name' => 'blog-card-3',
                                'key' => 'layouts/blog-card-3',
                                'name' => 'layouts.blog-card-3.index',
                                'crud'=>false
                            ],
                            'layouts_blog_card_4' => [
                                'title' => 'Blog Card 4',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-4.index'
                                ],
                                'path_name' => 'blog-card-4',
                                'key' => 'layouts/blog-card-4',
                                'name' => 'layouts.blog-card-4.index',
                                'crud'=>false
                            ],
                            'layouts_blog_card_5' => [
                                'title' => 'Blog Card 5',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-5.index'
                                ],
                                'path_name' => 'blog-card-5',
                                'key' => 'layouts/blog-card-5',
                                'name' => 'layouts.blog-card-5.index',
                                'crud'=>false
                            ],
                            'layouts_blog_card_6' => [
                                'title' => 'Blog Card 6',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-6.index'
                                ],
                                'path_name' => 'blog-card-6',
                                'key' => 'layouts/blog-card-6',
                                'name' => 'layouts.blog-card-6.index',
                                'crud'=>false
                            ],
                            'layouts_blog_card_7' => [
                                'title' => 'Blog Card 7',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-7.index'
                                ],
                                'path_name' => 'blog-card-7',
                                'key' => 'layouts/blog-card-7',
                                'name' => 'layouts.blog-card-7.index',
                                'crud'=>false
                            ],
                            'layouts_blog_card_8' => [
                                'title' => 'Blog Card 8',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-8.index'
                                ],
                                'path_name' => 'blog-card-8',
                                'key' => 'layouts/blog-card-8',
                                'name' => 'layouts.blog-card-8.index',
                                'crud'=>false
                            ],
                            'layouts_blog_details' => [
                                'title' => 'Blog Details',
                                'route_name' => [
                                    'name' => 'layouts.blog-details.index'
                                ],
                                'path_name' => 'blog-details',
                                'key' => 'layouts/blog-details',
                                'name' => 'layouts.blog-details.index',
                                'crud'=>false
                            ],
                        ]
                    ],
                    'layouts_help' => [
                        'title' => 'Help',
                        'path_name' => 'layouts',
                        'submenu' => [
                            'layouts_help_1' => [
                                'title' => 'Help 1',
                                'route_name' => [
                                    'name' => 'layouts.help-1.index'
                                ],
                                'path_name' => 'help-1',
                                'key' => 'layouts/help-1',
                                'name' => 'layouts.help-1.index',
                                'crud'=>false
                            ],
                            'layouts_help_2' => [
                                'title' => 'Help 2',
                                'route_name' => [
                                    'name' => 'layouts.help-2.index'
                                ],
                                'path_name' => 'help-2',
                                'key' => 'layouts/help-2',
                                'name' => 'layouts.help-2.index',
                                'crud'=>false
                            ],
                            'layouts_help_3' => [
                                'title' => 'Help 3',
                                'route_name' => [
                                    'name' => 'layouts.help-3.index'
                                ],
                                'path_name' => 'help-3',
                                'key' => 'layouts/help-3',
                                'name' => 'layouts.help-3.index',
                                'crud'=>false
                            ]
                        ]
                    ],
                    'layouts_price_list' => [
                        'title' => 'Price List',
                        'path_name' => 'layouts',
                        'submenu' => [
                            'layouts_price_list_1' => [
                                'title' => 'Price List 1',
                                'route_name' => [
                                    'name' => 'layouts.price-list-1.index'
                                ],
                                'path_name' => 'price-list-1',
                                'key' => 'layouts/price-list-1',
                                'name' => 'layouts.price-list-1.index',
                                'crud'=>false
                            ],
                            'layouts_price_list_2' => [
                                'title' => 'Price List 2',
                                'route_name' => [
                                    'name' => 'layouts.price-list-2.index'
                                ],
                                'path_name' => 'price-list-2',
                                'key' => 'layouts/price-list-2',
                                'name' => 'layouts.price-list-2.index',
                                'crud'=>false
                            ],
                            'layouts_price_list_3' => [
                                'title' => 'Price List 3',
                                'route_name' => [
                                    'name' => 'layouts.price-list-3.index'
                                ],
                                'path_name' => 'price-list-3',
                                'key' => 'layouts/price-list-3',
                                'name' => 'layouts.price-list-3.index',
                                'crud'=>false
                            ]
                        ]
                    ],
                    'layouts_invoice' => [
                        'title' => 'Invoice',
                        'path_name' => 'layouts',
                        'submenu' => [
                            'layouts_invoice_1' => [
                                'title' => 'Invoice 1',
                                'route_name' => [
                                    'name' => 'layouts.invoice-1.index'
                                ],
                                'path_name' => 'invoice-1',
                                'key' => 'layouts/invoice-1',
                                'name' => 'layouts.invoice-1.index',
                                'crud'=>false
                            ],
                            'layouts_invoice_2' => [
                                'title' => 'Invoice 2',
                                'route_name' => [
                                    'name' => 'layouts.invoice-2.index'
                                ],
                                'path_name' => 'invoice-2',
                                'key' => 'layouts/invoice-2',
                                'name' => 'layouts.invoice-2.index',
                                'crud'=>false
                            ]
                        ]
                    ],
                ],
                [
                    'layouts_sign_in' => [
                        'title' => 'Sign In',
                        'path_name' => 'layouts',
                        'submenu' => [
                            'layouts_invoice_1' => [
                                'title' => 'Sign In 1',
                                'route_name' => [
                                    'name' => 'layouts.sign-in-1.index'
                                ],
                                'path_name' => 'sign-in-1',
                                'key' => 'layouts/sign-in-1',
                                'name' => 'layouts.sign-in-1.index',
                                'crud'=>false
                            ],
                            'layouts_invoice_2' => [
                                'title' => 'Sign In 2',
                                'route_name' => [
                                    'name' => 'layouts.sign-in-2.index'
                                ],
                                'path_name' => 'sign-in-2',
                                'key' => 'layouts/sign-in-2',
                                'name' => 'layouts.sign-in-2.index',
                                'crud'=>false
                            ]
                        ]
                    ],
                    'layouts_sign_up' => [
                        'title' => 'Sign Up',
                        'path_name' => 'layouts',
                        'submenu' => [
                            'layouts_sign_up_1' => [
                                'title' => 'Sign Up 1',
                                'route_name' => [
                                    'name' => 'layouts.sign-up-1.index'
                                ],
                                'path_name' => 'sign-up-1',
                                'key' => 'layouts/sign-up-1',
                                'name' => 'layouts.sign-up-1.index',
                                'crud'=>false
                            ],
                            'layouts_sign_up_2' => [
                                'title' => 'Sign Up 2',
                                'route_name' => [
                                    'name' => 'layouts.sign-up-2.index'
                                ],
                                'path_name' => 'sign-up-2',
                                'key' => 'layouts/sign-up-2',
                                'name' => 'layouts.sign-up-2.index',
                                'crud'=>false
                            ]
                        ]
                    ],
                ],
                [
                    'layouts_error' => [
                        'title' => 'Error',
                        'path_name' => 'layouts',
                        'submenu' => [
                            'layouts_error_404_1' => [
                                'title' => 'Error 404 v1',
                                'route_name' => [
                                    'name' => 'layouts.error-404-1.index'
                                ],
                                'path_name' => 'error-404-1',
                                'key' => 'layouts/error-404-1',
                                'name' => 'layouts.error-404-1.index',
                                'crud'=>false
                            ],
                            'layouts_error_404_2' => [
                                'title' => 'Error 404 v2',
                                'route_name' => [
                                    'name' => 'layouts.error-404-2.index'
                                ],
                                'path_name' => 'error-404-2',
                                'key' => 'layouts/error-404-2',
                                'name' => 'layouts.error-404-2.index',
                                'crud'=>false
                            ],
                            'layouts_error_404_3' => [
                                'title' => 'Error 404 v3',
                                'route_name' => [
                                    'name' => 'layouts.error-404-3.index'
                                ],
                                'path_name' => 'error-404-3',
                                'key' => 'layouts/error-404-3',
                                'name' => 'layouts.error-404-3.index',
                                'crud'=>false
                            ],
                            'layouts_error_404_4' => [
                                'title' => 'Error 404 v4',
                                'route_name' => [
                                    'name' => 'layouts.error-404-4.index'
                                ],
                                'path_name' => 'error-404-4',
                                'key' => 'layouts/error-404-4',
                                'name' => 'layouts.error-404-4.index',
                                'crud'=>false
                            ],
                            'layouts_error_401' => [
                                'title' => 'Error 401',
                                'route_name' => [
                                    'name' => 'layouts.error-401.index'
                                ],
                                'path_name' => 'error-401',
                                'key' => 'layouts/error-401',
                                'name' => 'layouts.error-401.index',
                                'crud'=>false
                            ],
                            'layouts_error_429' => [
                                'title' => 'Error 429',
                                'route_name' => [
                                    'name' => 'layouts.error-429.index'
                                ],
                                'path_name' => 'error-429',
                                'key' => 'layouts/error-429',
                                'name' => 'layouts.error-429.index',
                                'crud'=>false
                            ],
                            'layouts_error_500' => [
                                'title' => 'Error 500',
                                'route_name' => [
                                    'name' => 'layouts.error-500.index'
                                ],
                                'path_name' => 'error-500',
                                'key' => 'layouts/error-500',
                                'name' => 'layouts.error-500.index',
                                'crud'=>false
                            ],
                        ]
                    ],
                    'layouts_starter' => [
                        'title' => 'Starter',
                        'path_name' => 'layouts',
                        'submenu' => [
                            'layouts_starter_blurred_header' => [
                                'title' => 'Blurred Header',
                                'route_name' => [
                                    'name' => 'layouts.starter-blurred-header.index'
                                ],
                                'path_name' => 'starter-blurred-header',
                                'key' => 'layouts/starter-blurred-header',
                                'name' => 'layouts.starter-blurred-header.index',
                                'crud'=>false
                            ],
                            'layouts_starter_unblurred_header' => [
                                'title' => 'Unblurred Header',
                                'route_name' => [
                                    'name' => 'layouts.starter-unblurred-header.index'
                                ],
                                'path_name' => 'starter-unblurred-header',
                                'key' => 'layouts/starter-unblurred-header',
                                'name' => 'layouts.starter-unblurred-header.index',
                                'crud'=>false
                            ],
                            'layouts_starter_centered_link' => [
                                'title' => 'Centered Links',
                                'route_name' => [
                                    'name' => 'layouts.starter-centered-link.index'
                                ],
                                'path_name' => 'starter-centered-link',
                                'key' => 'layouts/starter-centered-link',
                                'name' => 'layouts.starter-centered-link.index',
                                'crud'=>false
                            ],
                            'layouts_starter_minimal_sidebar' => [
                                'title' => 'Minimal Sidebar',
                                'route_name' => [
                                    'name' => 'layouts.starter-minimal-sidebar.index'
                                ],
                                'path_name' => 'starter-minimal-sidebar',
                                'key' => 'layouts/starter-minimal-sidebar',
                                'name' => 'layouts.starter-minimal-sidebar.index',
                                'crud'=>false
                            ],
                            'layouts_starter_sideblock' => [
                                'title' => 'Sideblock',
                                'route_name' => [
                                    'name' => 'layouts.starter-sideblock.index'
                                ],
                                'path_name' => 'starter-sideblock',
                                'key' => 'layouts/starter-sideblock',
                                'name' => 'layouts.starter-sideblock.index',
                                'crud'=>false
                            ],
                        ]
                    ],
                ],
            ]
        ];
    }

    public static function apps()
    {
        return [
            'title' => 'Applications',
            'icon' => 'fa-archive',
            'path_name' => 'apps',
            'items' => [
                [
                    'apps_chat' => [
                        'title' => 'Chat App',
                        'route_name' => [
                            'name' => 'apps.chat.index'
                        ],
                        'path_name' => '/chat',
                        'key' => 'apps/chat',
                        'name' => 'apps.chat.index',
                        'crud'=>false
                    ],
                    'apps_kanban' => [
                        'title' => 'Kanban Board',
                        'route_name' => [
                            'name' => 'apps.kanban.index'
                        ],
                        'path_name' => '/kanban',
                        'key' => 'apps/kanban',
                        'name' => 'apps.kanban.index',
                        'crud'=>false
                    ],
                    'apps_filemanager' => [
                        'title' => 'File Manager',
                        'route_name' => [
                            'name' => 'apps.filemanager.index'
                        ],
                        'path_name' => '/filemanager',
                        'key' => 'apps/filemanager',
                        'name' => 'apps.filemanager.index',
                        'crud'=>false
                    ],
                    'apps_mail' => [
                        'title' => 'Mail App',
                        'route_name' => [
                            'name' => 'apps.mail.index'
                        ],
                        'path_name' => '/mail',
                        'key' => 'apps/mail',
                        'name' => 'apps.mail.index',
                        'crud'=>false
                    ],
                    'apps_todo' => [
                        'title' => 'Todo App',
                        'route_name' => [
                            'name' => 'apps.todo.index'
                        ],
                        'path_name' => '/todo',
                        'key' => 'apps/todo',
                        'name' => 'apps.todo.index',
                        'crud'=>false
                    ],
                ],
                [
                    'apps_nft_1' => [
                        'title' => 'NFT Apps v1',
                        'route_name' => [
                            'name' => 'apps.nft1.index'
                        ],
                        'path_name' => '/nft1',
                        'key' => 'apps/nft1',
                        'name' => 'apps.nft1.index',
                        'crud'=>false
                    ],
                    'apps_nft_2' => [
                        'title' => 'NFT Apps v2',
                        'route_name' => [
                            'name' => 'apps.nft2.index'
                        ],
                        'path_name' => '/nft2',
                        'key' => 'apps/nft2',
                        'name' => 'apps.nft2.index',
                        'crud'=>false
                    ],
                    'apps_pos' => [
                        'title' => 'POS System',
                        'route_name' => [
                            'name' => 'apps.pos.index'
                        ],
                        'path_name' => '/pos',
                        'key' => 'apps/pos',
                        'name' => 'apps.pos.index',
                        'crud'=>false
                    ],
                    'apps_travel' => [
                        'title' => 'Travel App',
                        'route_name' => [
                            'name' => 'apps.travel.index'
                        ],
                        'path_name' => '/travel',
                        'key' => 'apps/travel',
                        'name' => 'apps.travel.index',
                        'crud'=>false
                    ]
                ],
            ]
        ];
    }

    public static function dashboards()
    {
        return [
            'title' => 'Dashboards',
            'icon' => 'fa-tachometer-alt',
            'path_name' => 'dashboards',
            'items' => [
                [
                    'dashboards_crm_analytics' => [
                        'title' => 'CRM Analytics',
                        'route_name' => [
                            'name' => 'dashboards.crm-analytics.index'
                        ],
                        'path_name' => 'crm-analytics',
                        'key' => 'dashboards/crm-analytics',
                        'name' => 'dashboards.crm-analytics.index',
                        'crud'=>false
                    ],
                    'dashboards_orders' => [
                        'title' => 'Orders',
                        'route_name' => [
                            'name' => 'dashboards.orders.index'
                        ],
                        'path_name' => 'orders',
                        'key' => 'dashboards/orders',
                        'name' => 'dashboards.orders.index',
                        'crud'=>false
                    ],
                ],
                [
                    'dashboards_crypto' => [
                        'title' => 'Cryptocurrency',
                        'path_name' => 'dashboards',
                        'submenu' => [
                            'dashboards_crypto_1' => [
                                'title' => 'Cryptocurrency v1',
                                'route_name' => [
                                    'name' => 'dashboards.crypto-1.index'
                                ],
                                'path_name' => 'crypto-1',
                                'key' => 'dashboards/crypto-1',
                                'name' => 'dashboards.crypto-1.index',
                                'crud'=>false
                            ],
                            'dashboards_crypto_2' => [
                                'title' => 'Cryptocurrency v2',
                                'route_name' => [
                                    'name' => 'dashboards.crypto-2.index'
                                ],
                                'path_name' => 'crypto-2',
                                'key' => 'dashboards/crypto-2',
                                'name' => 'dashboards.crypto-2.index',
                                'crud'=>false
                            ]
                        ]
                    ],
                    'dashboards_banking' => [
                        'title' => 'Banking',
                        'path_name' => 'dashboards',
                        'submenu' => [
                            'dashboards_banking_1' => [
                                'title' => 'Banking v1',
                                'route_name' => [
                                    'name' => 'dashboards.banking-1.index'
                                ],
                                'path_name' => 'banking-1',
                                'key' => 'dashboards/banking-1',
                                'name' => 'dashboards.banking-1.index',
                                'crud'=>false
                            ],
                            'dashboards_banking_2' => [
                                'title' => 'Banking v2',
                                'route_name' => [
                                    'name' => 'dashboards.banking-2.index'
                                ],
                                'path_name' => 'banking-2',
                                'key' => 'dashboards/banking-2',
                                'name' => 'dashboards.banking-2.index',
                                'crud'=>false
                            ]
                        ]
                    ],
                    'dashboards_personal' => [
                        'title' => 'Personal',
                        'route_name' => [
                            'name' => 'dashboards.personal.index'
                        ],
                        'path_name' => 'personal',
                        'key' => 'dashboards/personal',
                        'name' => 'dashboards.personal.index',
                        'crud'=>false
                    ],
                    'dashboards_cms_analytics' => [
                        'title' => 'CMS Analytics',
                        'route_name' => [
                            'name' => 'dashboards.cms-analytics.index'
                        ],
                        'path_name' => 'cms-analytics',
                        'key' => 'dashboards/cms-analytics',
                        'name' => 'dashboards.cms-analytics.index',
                        'crud'=>false
                    ],
                    'dashboards_influencer' => [
                        'title' => 'Influencer',
                        'route_name' => [
                            'name' => 'dashboards.influencer.index'
                        ],
                        'path_name' => 'influencer',
                        'key' => 'dashboards/influencer',
                        'name' => 'dashboards.influencer.index',
                        'crud'=>false
                    ],
                    'dashboards_travel' => [
                        'title' => 'Travel',
                        'route_name' => [
                            'name' => 'dashboards.travel.index'
                        ],
                        'path_name' => 'travel',
                        'key' => 'dashboards/travel',
                        'name' => 'dashboards.travel.index',
                        'crud'=>false
                    ],
                    'dashboards_teacher' => [
                        'title' => 'Teacher',
                        'route_name' => [
                            'name' => 'dashboards.teacher.index'
                        ],
                        'path_name' => 'teacher',
                        'key' => 'dashboards/teacher',
                        'name' => 'dashboards.teacher.index',
                        'crud'=>false
                    ],
                    'dashboards_education' => [
                        'title' => 'Education',
                        'route_name' => [
                            'name' => 'dashboards.education.index'
                        ],
                        'path_name' => 'education',
                        'key' => 'dashboards/education',
                        'name' => 'dashboards.education.index',
                        'crud'=>false
                    ],
                    'dashboards_authors' => [
                        'title' => 'Authors',
                        'route_name' => [
                            'name' => 'dashboards.authors.index'
                        ],
                        'path_name' => 'authors',
                        'key' => 'dashboards/authors',
                        'name' => 'dashboards.authors.index',
                        'crud'=>false
                    ],
                    'dashboards_doctor' => [
                        'title' => 'Doctor',
                        'route_name' => [
                            'name' => 'dashboards.doctor.index'
                        ],
                        'path_name' => 'doctor',
                        'key' => 'dashboards/doctor',
                        'name' => 'dashboards.doctor.index',
                        'crud'=>false
                    ],
                    'dashboards_employees' => [
                        'title' => 'Employees',
                        'route_name' => [
                            'name' => 'dashboards.employees.index'
                        ],
                        'path_name' => 'employees',
                        'key' => 'dashboards/employees',
                        'name' => 'dashboards.employees.index',
                        'crud'=>false
                    ],
                    'dashboards_workspaces' => [
                        'title' => 'Workspaces',
                        'route_name' => [
                            'name' => 'dashboards.workspaces.index'
                        ],
                        'path_name' => 'workspaces',
                        'key' => 'dashboards/workspaces',
                        'name' => 'dashboards.workspaces.index',
                        'crud'=>false
                    ],
                    'dashboards_meetings' => [
                        'title' => 'Meetings',
                        'route_name' => [
                            'name' => 'dashboards.meetings.index'
                        ],
                        'path_name' => 'meetings',
                        'key' => 'dashboards/meetings',
                        'name' => 'dashboards.meetings.index',
                        'crud'=>false
                    ],
                    'dashboards_project_boards' => [
                        'title' => 'Project Boards',
                        'route_name' => [
                            'name' => 'dashboards.project-boards.index'
                        ],
                        'path_name' => 'project-boards',
                        'key' => 'dashboards/project-boards',
                        'name' => 'dashboards.project-boards.index',
                        'crud'=>false
                    ],
                ],
                [
                    'dashboards_widget_ui' => [
                        'title' => 'Widget UI',
                        'route_name' => [
                            'name' => 'dashboards.widget-ui.index'
                        ],
                        'path_name' => 'widget-ui',
                        'key' => 'dashboards/widget-ui',
                        'name' => 'dashboards.widget-ui.index',
                        'crud'=>false
                    ],
                    'dashboards_widget_contacts' => [
                        'title' => 'Widget Contacts',
                        'route_name' => [
                            'name' => 'dashboards.widget-contacts.index'
                        ],
                        'path_name' => 'widget-contacts',
                        'key' => 'dashboards/widget-contacts',
                        'name' => 'dashboards.widget-contacts.index',
                        'crud'=>false
                    ],
                ],
            ]
        ];
    }

    
    public static function oprational()
    {
        return [
            'title' => 'Operacional',
            'icon' => 'fa-archive',
            'path_name' => 'operacional',
            'items' => [
                [
                    'operacional_user' => [
                        'title' => 'Users',
                        'route_name' => [
                            'name' => 'users.index'
                        ],
                        'path_name' => '/users',
                        'key' => 'operacional/users',
                        'name' => 'users.index',
                        'crud'=>true
                    ],
                    'operacional_role' => [
                        'title' => 'Roles',
                        'route_name' => [
                            'name' => 'roles.index'
                        ],
                        'path_name' => '/roles',
                        'key' => 'operacional/roles',
                        'name' => 'roles.index',
                        'crud'=>true
                    ],
                    'operacional_permission' => [
                        'title' => 'Permissions',
                        'route_name' => [
                            'name' => 'permissions.index'
                        ],
                        'path_name' => '/permissions',
                        'key' => 'operacional/permissions',
                        'name' => 'permissions.index',
                        'crud'=>true
                    ],
                    'operacional_make' => [
                        'title' => 'Makes',
                        'route_name' => [
                            'name' => 'makes.index'
                        ],
                        'path_name' => '/makes',
                        'key' => 'operacional/makes',
                        'name' => 'makes.index',
                        'crud'=>true
                    ],
                    'operacional_post' => [
                        'title' => 'Posts',
                        'route_name' => [
                            'name' => 'posts.index'
                        ],
                        'path_name' => '/posts',
                        'key' => 'operacional/posts',
                        'name' => 'posts.index',
                        'crud'=>true
                    ],
                    'operacional_categories' => [
                        'title' => 'Categories',
                        'route_name' => [
                            'name' => 'categories.index'
                        ],
                        'path_name' => '/categories',
                        'key' => 'operacional/categories',
                        'name' => 'categories.index',
                        'crud'=>true
                    ],
                    'operacional_icones' => [
                        'title' => 'Icones',
                        'route_name' => [
                            'name' => 'icones.index'
                        ],
                        'component' => 'icones',
                        'path_name' => '/icones',
                        'key' => 'operacional/icones',
                        'name' => 'icones.index',
                        'crud'=>false
                    ]
                ],
            ]
        ];
    }


    public static function all()
    {
        return [
        self::dashboards(), 
        // self::apps(), 
        // self::layouts(), 
        self::forms(),
        //  self::components(), 
        //  self::elements(), 
         self::oprational()
        ];
    }

    /**
     * Bind data to the view.
     *
     * @return void
     */
    public static function get()
    {
        $view = [];
        if (!is_null(request()->route())) {
            $pageName = request()->route()->getName();
            $routePrefix = explode('/', $pageName)[0] ?? '';

            switch ($routePrefix) {
                case 'elements':
                    $view['elements'] = self::elements();
                    break;
                case 'components':
                    $view['components'] = self::components();
                    break;
                case 'forms':
                    $view['forms'] = self::forms();
                    break;
                case 'layouts':
                    $view['layouts'] = self::layouts();
                    break;
                case 'apps':
                    $view['apps'] = self::apps();
                    break;
                case 'dashboards':
                    $view['dashboards'] = self::dashboards();
                    break;
                case 'oprational':
                    $view['oprational'] = self::oprational();
                    break;
                default:
                    $view['dashboards'] = self::dashboards();
            }
            $menus = SidebarPanel::all();
            $main = collect($menus)->map(function ($item) {
                return [
                    'title' => data_get($item, 'title'),
                    'icon' => data_get($item, 'icon'),
                    'items' => data_get($item, 'items', []),
                ];
            });
            $view['main'] = $main;
            $view['allSidebarItems'] = $menus;
            $view['pageName'] = $pageName;
            $view['routePrefix'] = $routePrefix;
            return $view;
        }
    }
}
