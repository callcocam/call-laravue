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
                            'name' => 'elements.avatar'
                        ],
                        'path_name' => '/avatar',
                        'key' => 'elements/avatar'
                    ],
                    'elements_alert' => [
                        'title' => 'Alert',
                        'route_name' => [
                            'name' => 'elements.alert'
                        ],
                        'path_name' => '/alert',
                        'key' => 'elements/alert'
                    ],
                    'elements_button' => [
                        'title' => 'Button',
                        'route_name' => [
                            'name' => 'elements.button'
                        ],
                        'path_name' => '/button',
                        'key' => 'elements/button'
                    ],
                    'elements_button_group' => [
                        'title' => 'Button Group',
                        'route_name' => [
                            'name' => 'elements.button-group'
                        ],
                        'path_name' => '/button-group',
                        'key' => 'elements/button-group'
                    ],
                    'elements_badge' => [
                        'title' => 'Badge',
                        'route_name' => [
                            'name' => 'elements.badge'
                        ],
                        'path_name' => '/badge',
                        'key' => 'elements/badge'
                    ],
                    'elements_breadcrumb' => [
                        'title' => 'Breadcrumb',
                        'route_name' => [
                            'name' => 'elements.breadcrumb'
                        ],
                        'path_name' => '/breadcrumb',
                        'key' => 'elements/breadcrumb'
                    ],
                    'elements_card' => [
                        'title' => 'Card',
                        'route_name' => [
                            'name' => 'elements.card'
                        ],
                        'path_name' => '/card',
                        'key' => 'elements/card'
                    ],
                    'elements_divider' => [
                        'title' => 'Divider',
                        'route_name' => [
                            'name' => 'elements.divider'
                        ],
                        'path_name' => '/divider',
                        'key' => 'elements/divider'
                    ],
                    'elements_mask' => [
                        'title' => 'Mask',
                        'route_name' => [
                            'name' => 'elements.mask'
                        ],
                        'path_name' => '/mask',
                        'key' => 'elements/mask'
                    ],
                    'elements_progress' => [
                        'title' => 'Progress',
                        'route_name' => [
                            'name' => 'elements.progress'
                        ],
                        'path_name' => '/progress',
                        'key' => 'elements/progress'
                    ],
                    'elements_skeleton' => [
                        'title' => 'Skeleton',
                        'route_name' => [
                            'name' => 'elements.skeleton'
                        ],
                        'path_name' => '/skeleton',
                        'key' => 'elements/skeleton'
                    ],
                    'elements_spinner' => [
                        'title' => 'Spinner',
                        'route_name' => [
                            'name' => 'elements.spinner'
                        ],
                        'path_name' => '/spinner',
                        'key' => 'elements/spinner'
                    ],
                    'elements_tag' => [
                        'title' => 'Tag',
                        'route_name' => [
                            'name' => 'elements.tag'
                        ],
                        'path_name' => '/tag',
                        'key' => 'elements/tag'
                    ],
                    'elements_tooltip' => [
                        'title' => 'Tooltip',
                        'route_name' => [
                            'name' => 'elements.tooltip'
                        ],
                        'path_name' => '/tooltip',
                        'key' => 'elements/tooltip'
                    ],
                ],
                [
                    'elements_forms' => [
                        'title' => 'Forms',
                        'route_name' => [
                            'name' => 'forms.input-text'
                        ],
                        'path_name' => '/input-text',
                        'key' => 'forms/input-text'
                    ],
                    'elements_typography' => [
                        'title' => 'Typography',
                        'route_name' => [
                            'name' => 'elements.typography'
                        ],
                        'path_name' => '/typography',
                        'key' => 'elements/typography'
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
                            'name' => 'components.accordion'
                        ],
                        'path_name' => '/accordion',
                        'key' => 'components/accordion'
                    ],
                    'components_collapse' => [
                        'title' => 'Collapse',
                        'route_name' => [
                            'name' => 'components.collapse'
                        ],
                        'path_name' => '/collapse',
                        'key' => 'components/collapse'
                    ],
                    'components_tab' => [
                        'title' => 'Tab',
                        'route_name' => [
                            'name' => 'components.tab'
                        ],
                        'path_name' => '/tab',
                        'key' => 'components/tab'
                    ],
                    'components_dropdown' => [
                        'title' => 'Dropdown',
                        'route_name' => [
                            'name' => 'components.dropdown'
                        ],
                        'path_name' => '/dropdown',
                        'key' => 'components/dropdown'
                    ],
                    'components_popover' => [
                        'title' => 'Popover',
                        'route_name' => [
                            'name' => 'components.popover'
                        ],
                        'path_name' => '/popover',
                        'key' => 'components/popover'
                    ],
                    'components_modal' => [
                        'title' => 'Modal',
                        'route_name' => [
                            'name' => 'components.modal'
                        ],
                        'path_name' => '/modal',
                        'key' => 'components/modal'
                    ],
                    'components_drawer' => [
                        'title' => 'Drawer',
                        'route_name' => [
                            'name' => 'components.drawer'
                        ],
                        'path_name' => '/drawer',
                        'key' => 'components/drawer'
                    ],
                    'components_steps' => [
                        'title' => 'Steps',
                        'route_name' => [
                            'name' => 'components.steps'
                        ],
                        'path_name' => '/steps',
                        'key' => 'components/steps'
                    ],
                    'components_timeline' => [
                        'title' => 'Timeline',
                        'route_name' => [
                            'name' => 'components.timeline'
                        ],
                        'path_name' => '/timeline',
                        'key' => 'components/timeline'
                    ],
                    'components_pagination' => [
                        'title' => 'Pagination',
                        'route_name' => [
                            'name' => 'components.pagination'
                        ],
                        'path_name' => '/pagination',
                        'key' => 'components/pagination'
                    ],
                    'components_menu_list' => [
                        'title' => 'Menu List',
                        'route_name' => [
                            'name' => 'components.menu-list'
                        ],
                        'path_name' => '/menu-list',
                        'key' => 'components/menu-list'
                    ],
                    'components_treeview' => [
                        'title' => 'Treeview',
                        'route_name' => [
                            'name' => 'components.treeview'
                        ],
                        'path_name' => '/treeview',
                        'key' => 'components/treeview'
                    ],

                ],
                [
                    'components_table' => [
                        'title' => 'Table',
                        'route_name' => [
                            'name' => 'components.table'
                        ],
                        'path_name' => '/table',
                        'key' => 'components/table'
                    ],

                    'components_table_advanced' => [
                        'title' => 'Table Advanced',
                        'route_name' => [
                            'name' => 'components.table-advanced'
                        ],
                        'path_name' => '/table-advanced',
                        'key' => 'components/table-advanced'
                    ],

                    'components_table_gridjs' => [
                        'title' => 'Table Gridjs',
                        'route_name' => [
                            'name' => 'components.gridjs'
                        ],
                        'path_name' => '/gridjs',
                        'key' => 'components/gridjs'
                    ],
                ],
                [
                    'components_apexchart' => [
                        'title' => 'Apexcharts',
                        'route_name' => [
                            'name' => 'components.apexchart'
                        ],
                        'path_name' => '/apexchart',
                        'key' => 'components/apexchart'
                    ],

                    'components_carousel' => [
                        'title' => 'Carousel',
                        'route_name' => [
                            'name' => 'components.carousel'
                        ],
                        'path_name' => '/carousel',
                        'key' => 'components/carousel'
                    ],

                    'components_notification' => [
                        'title' => 'Notification',
                        'route_name' => [
                            'name' => 'components.notification'
                        ],
                        'path_name' => '/notification',
                        'key' => 'components/notification'
                    ],
                ],
                [
                    'components_extension_clipboard' => [
                        'title' => 'Clipboard',
                        'route_name' => [
                            'name' => 'components.extension-clipboard'
                        ],
                        'path_name' => '/extension-clipboard',
                        'key' => 'components/extension-clipboard'
                    ],
                    'components_extension_persist' => [
                        'title' => 'Persist',
                        'route_name' => [
                            'name' => 'components.extension-persist'
                        ],
                        'path_name' => '/extension-persist',
                        'key' => 'components/extension-persist'
                    ],
                    'components_extension_monochrome' => [
                        'title' => 'Monochrome Mode',
                        'route_name' => [
                            'name' => 'components.extension-monochrome'
                        ],
                        'path_name' => '/extension-monochrome',
                        'key' => 'components/extension-monochrome'
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
                            'name' => 'forms.layout-v1'
                        ],
                        'path_name' => '/layout-v1',
                        'key' => 'forms/layout-v1'
                    ],
                    'forms_layout_v2' => [
                        'title' => 'Form Layout v2',
                        'route_name' => [
                            'name' => 'forms.layout-v2'
                        ],
                        'path_name' => '/layout-v2',
                        'key' => 'forms/layout-v2'
                    ],
                    'forms_layout_v3' => [
                        'title' => 'Form Layout v3',
                        'route_name' => [
                            'name' => 'forms.layout-v3'
                        ],
                        'path_name' => '/layout-v3',
                        'key' => 'forms/layout-v3'
                    ],
                    'forms_layout_v4' => [
                        'title' => 'Form Layout v4',
                        'route_name' => [
                            'name' => 'forms.layout-v4'
                        ],
                        'path_name' => '/layout-v4',
                        'key' => 'forms/layout-v4'
                    ],
                    'forms_layout_v5' => [
                        'title' => 'Form Layout v5',
                        'route_name' => [
                            'name' => 'forms.layout-v5'
                        ],
                        'path_name' => '/layout-v5',
                        'key' => 'forms/layout-v5'
                    ],
                ],
                [
                    'forms_input_text' => [
                        'title' => 'Input text',
                        'route_name' => [
                            'name' => 'forms.input-text'
                        ],
                        'path_name' => '/input-text',
                        'key' => 'forms/input-text'
                    ],
                    'forms_input_group' => [
                        'title' => 'Input group',
                        'route_name' => [
                            'name' => 'forms.input-group'
                        ],
                        'path_name' => '/input-group',
                        'key' => 'forms/input-group'
                    ],
                    'forms_input_mask' => [
                        'title' => 'Input mask',
                        'route_name' => [
                            'name' => 'forms.input-mask'
                        ],
                        'path_name' => '/input-mask',
                        'key' => 'forms/input-mask'
                    ],
                    'forms_checkbox' => [
                        'title' => 'Checkbox',
                        'route_name' => [
                            'name' => 'forms.checkbox'
                        ],
                        'path_name' => '/checkbox',
                        'key' => 'forms/checkbox'
                    ],
                    'forms_radio' => [
                        'title' => 'Radio',
                        'route_name' => [
                            'name' => 'forms.radio'
                        ],
                        'path_name' => '/radio',
                        'key' => 'forms/radio'
                    ],
                    'forms_switch' => [
                        'title' => 'Switch',
                        'route_name' => [
                            'name' => 'forms.switch'
                        ],
                        'path_name' => '/switch',
                        'key' => 'forms/switch'
                    ],
                    'forms_select' => [
                        'title' => 'Select',
                        'route_name' => [
                            'name' => 'forms.select'
                        ],
                        'path_name' => '/select',
                        'key' => 'forms/select'
                    ],
                    'forms_tom_select' => [
                        'title' => 'Tom select',
                        'route_name' => [
                            'name' => 'forms.tom-select'
                        ],
                        'path_name' => '/tom-select',
                        'key' => 'forms/tom-select'
                    ],
                    'forms_textarea' => [
                        'title' => 'Textarea',
                        'route_name' => [
                            'name' => 'forms.textarea'
                        ],
                        'path_name' => '/textarea',
                        'key' => 'forms/textarea'
                    ],
                    'forms_range' => [
                        'title' => 'Range',
                        'route_name' => [
                            'name' => 'forms.range'
                        ],
                        'path_name' => '/range',
                        'key' => 'forms/range'
                    ],
                    'forms_datepicker' => [
                        'title' => 'Datepicker',
                        'route_name' => [
                            'name' => 'forms.datepicker'
                        ],
                        'path_name' => '/datepicker',
                        'key' => 'forms/datepicker'
                    ],
                    'forms_timepicker' => [
                        'title' => 'Timepicker',
                        'route_name' => [
                            'name' => 'forms.timepicker'
                        ],
                        'path_name' => '/timepicker',
                        'key' => 'forms/timepicker'
                    ],
                    'forms_datetimepicker' => [
                        'title' => 'Datetimepicker',
                        'route_name' => [
                            'name' => 'forms.datetimepicker'
                        ],
                        'path_name' => '/datetimepicker',
                        'key' => 'forms/datetimepicker'
                    ],
                    'forms_text_editor' => [
                        'title' => 'Text editor',
                        'route_name' => [
                            'name' => 'forms.text-editor'
                        ],
                        'path_name' => '/text-editor',
                        'key' => 'forms/text-editor'
                    ],
                    'forms_upload' => [
                        'title' => 'Form upload',
                        'route_name' => [
                            'name' => 'forms.upload'
                        ],
                        'path_name' => '/upload',
                        'key' => 'forms/upload'
                    ],
                    'forms_validation' => [
                        'title' => 'Form Validation',
                        'route_name' => [
                            'name' => 'forms.validation'
                        ],
                        'path_name' => '/validation',
                        'key' => 'forms/validation'
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
                                    'name' => 'layouts.onboarding-1'
                                ],
                                'path_name' => 'onboarding-1',
                                'key' => 'layouts/onboarding-1'
                            ],
                            'layouts_onboarding_2' => [
                                'title' => 'Onboarding 2',
                                'route_name' => [
                                    'name' => 'layouts.onboarding-2'
                                ],
                                'path_name' => 'onboarding-2',
                                'key' => 'layouts/onboarding-2'
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
                                    'name' => 'layouts.user-card-1'
                                ],
                                'path_name' => 'user-card-1',
                                'key' => 'layouts/user-card-1'
                            ],
                            'layouts_user_card_2' => [
                                'title' => 'User Card 2',
                                'route_name' => [
                                    'name' => 'layouts.user-card-2'
                                ],
                                'path_name' => 'user-card-2',
                                'key' => 'layouts/user-card-2'
                            ],
                            'layouts_user_card_3' => [
                                'title' => 'User Card 3',
                                'route_name' => [
                                    'name' => 'layouts.user-card-3'
                                ],
                                'path_name' => 'user-card-3',
                                'key' => 'layouts/user-card-3'
                            ],
                            'layouts_user_card_4' => [
                                'title' => 'User Card 4',
                                'route_name' => [
                                    'name' => 'layouts.user-card-4'
                                ],
                                'path_name' => 'user-card-4',
                                'key' => 'layouts/user-card-4'
                            ],
                            'layouts_user_card_5' => [
                                'title' => 'User Card 5',
                                'route_name' => [
                                    'name' => 'layouts.user-card-5'
                                ],
                                'path_name' => 'user-card-5',
                                'key' => 'layouts/user-card-5'
                            ],
                            'layouts_user_card_6' => [
                                'title' => 'User Card 6',
                                'route_name' => [
                                    'name' => 'layouts.user-card-6'
                                ],
                                'path_name' => 'user-card-6',
                                'key' => 'layouts/user-card-6'
                            ],
                            'layouts_user_card_7' => [
                                'title' => 'User Card 7',
                                'route_name' => [
                                    'name' => 'layouts.user-card-7'
                                ],
                                'path_name' => 'user-card-7',
                                'key' => 'layouts/user-card-7'
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
                                    'name' => 'layouts.blog-card-1'
                                ],
                                'path_name' => 'blog-card-1',
                                'key' => 'layouts/blog-card-1'
                            ],
                            'layouts_blog_card_2' => [
                                'title' => 'Blog Card 2',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-2'
                                ],
                                'path_name' => 'blog-card-2',
                                'key' => 'layouts/blog-card-2'
                            ],
                            'layouts_blog_card_3' => [
                                'title' => 'Blog Card 3',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-3'
                                ],
                                'path_name' => 'blog-card-3',
                                'key' => 'layouts/blog-card-3'
                            ],
                            'layouts_blog_card_4' => [
                                'title' => 'Blog Card 4',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-4'
                                ],
                                'path_name' => 'blog-card-4',
                                'key' => 'layouts/blog-card-4'
                            ],
                            'layouts_blog_card_5' => [
                                'title' => 'Blog Card 5',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-5'
                                ],
                                'path_name' => 'blog-card-5',
                                'key' => 'layouts/blog-card-5'
                            ],
                            'layouts_blog_card_6' => [
                                'title' => 'Blog Card 6',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-6'
                                ],
                                'path_name' => 'blog-card-6',
                                'key' => 'layouts/blog-card-6'
                            ],
                            'layouts_blog_card_7' => [
                                'title' => 'Blog Card 7',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-7'
                                ],
                                'path_name' => 'blog-card-7',
                                'key' => 'layouts/blog-card-7'
                            ],
                            'layouts_blog_card_8' => [
                                'title' => 'Blog Card 8',
                                'route_name' => [
                                    'name' => 'layouts.blog-card-8'
                                ],
                                'path_name' => 'blog-card-8',
                                'key' => 'layouts/blog-card-8'
                            ],
                            'layouts_blog_details' => [
                                'title' => 'Blog Details',
                                'route_name' => [
                                    'name' => 'layouts.blog-details'
                                ],
                                'path_name' => 'blog-details',
                                'key' => 'layouts/blog-details'
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
                                    'name' => 'layouts.help-1'
                                ],
                                'path_name' => 'help-1',
                                'key' => 'layouts/help-1'
                            ],
                            'layouts_help_2' => [
                                'title' => 'Help 2',
                                'route_name' => [
                                    'name' => 'layouts.help-2'
                                ],
                                'path_name' => 'help-2',
                                'key' => 'layouts/help-2'
                            ],
                            'layouts_help_3' => [
                                'title' => 'Help 3',
                                'route_name' => [
                                    'name' => 'layouts.help-3'
                                ],
                                'path_name' => 'help-3',
                                'key' => 'layouts/help-3'
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
                                    'name' => 'layouts.price-list-1'
                                ],
                                'path_name' => 'price-list-1',
                                'key' => 'layouts/price-list-1'
                            ],
                            'layouts_price_list_2' => [
                                'title' => 'Price List 2',
                                'route_name' => [
                                    'name' => 'layouts.price-list-2'
                                ],
                                'path_name' => 'price-list-2',
                                'key' => 'layouts/price-list-2'
                            ],
                            'layouts_price_list_3' => [
                                'title' => 'Price List 3',
                                'route_name' => [
                                    'name' => 'layouts.price-list-3'
                                ],
                                'path_name' => 'price-list-3',
                                'key' => 'layouts/price-list-3'
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
                                    'name' => 'layouts.invoice-1'
                                ],
                                'path_name' => 'invoice-1',
                                'key' => 'layouts/invoice-1'
                            ],
                            'layouts_invoice_2' => [
                                'title' => 'Invoice 2',
                                'route_name' => [
                                    'name' => 'layouts.invoice-2'
                                ],
                                'path_name' => 'invoice-2',
                                'key' => 'layouts/invoice-2'
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
                                    'name' => 'layouts.sign-in-1'
                                ],
                                'path_name' => 'sign-in-1',
                                'key' => 'layouts/sign-in-1'
                            ],
                            'layouts_invoice_2' => [
                                'title' => 'Sign In 2',
                                'route_name' => [
                                    'name' => 'layouts.sign-in-2'
                                ],
                                'path_name' => 'sign-in-2',
                                'key' => 'layouts/sign-in-2'
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
                                    'name' => 'layouts.sign-up-1'
                                ],
                                'path_name' => 'sign-up-1',
                                'key' => 'layouts/sign-up-1'
                            ],
                            'layouts_sign_up_2' => [
                                'title' => 'Sign Up 2',
                                'route_name' => [
                                    'name' => 'layouts.sign-up-2'
                                ],
                                'path_name' => 'sign-up-2',
                                'key' => 'layouts/sign-up-2'
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
                                    'name' => 'layouts.error-404-1'
                                ],
                                'path_name' => 'error-404-1',
                                'key' => 'layouts/error-404-1'
                            ],
                            'layouts_error_404_2' => [
                                'title' => 'Error 404 v2',
                                'route_name' => [
                                    'name' => 'layouts.error-404-2'
                                ],
                                'path_name' => 'error-404-2',
                                'key' => 'layouts/error-404-2'
                            ],
                            'layouts_error_404_3' => [
                                'title' => 'Error 404 v3',
                                'route_name' => [
                                    'name' => 'layouts.error-404-3'
                                ],
                                'path_name' => 'error-404-3',
                                'key' => 'layouts/error-404-3'
                            ],
                            'layouts_error_404_4' => [
                                'title' => 'Error 404 v4',
                                'route_name' => [
                                    'name' => 'layouts.error-404-4'
                                ],
                                'path_name' => 'error-404-4',
                                'key' => 'layouts/error-404-4'
                            ],
                            'layouts_error_401' => [
                                'title' => 'Error 401',
                                'route_name' => [
                                    'name' => 'layouts.error-401'
                                ],
                                'path_name' => 'error-401',
                                'key' => 'layouts/error-401'
                            ],
                            'layouts_error_429' => [
                                'title' => 'Error 429',
                                'route_name' => [
                                    'name' => 'layouts.error-429'
                                ],
                                'path_name' => 'error-429',
                                'key' => 'layouts/error-429'
                            ],
                            'layouts_error_500' => [
                                'title' => 'Error 500',
                                'route_name' => [
                                    'name' => 'layouts.error-500'
                                ],
                                'path_name' => 'error-500',
                                'key' => 'layouts/error-500'
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
                                    'name' => 'layouts.starter-blurred-header'
                                ],
                                'path_name' => 'starter-blurred-header',
                                'key' => 'layouts/starter-blurred-header'
                            ],
                            'layouts_starter_unblurred_header' => [
                                'title' => 'Unblurred Header',
                                'route_name' => [
                                    'name' => 'layouts.starter-unblurred-header'
                                ],
                                'path_name' => 'starter-unblurred-header',
                                'key' => 'layouts/starter-unblurred-header'
                            ],
                            'layouts_starter_centered_link' => [
                                'title' => 'Centered Links',
                                'route_name' => [
                                    'name' => 'layouts.starter-centered-link'
                                ],
                                'path_name' => 'starter-centered-link',
                                'key' => 'layouts/starter-centered-link'
                            ],
                            'layouts_starter_minimal_sidebar' => [
                                'title' => 'Minimal Sidebar',
                                'route_name' => [
                                    'name' => 'layouts.starter-minimal-sidebar'
                                ],
                                'path_name' => 'starter-minimal-sidebar',
                                'key' => 'layouts/starter-minimal-sidebar'
                            ],
                            'layouts_starter_sideblock' => [
                                'title' => 'Sideblock',
                                'route_name' => [
                                    'name' => 'layouts.starter-sideblock'
                                ],
                                'path_name' => 'starter-sideblock',
                                'key' => 'layouts/starter-sideblock'
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
                            'name' => 'apps.chat'
                        ],
                        'path_name' => '/chat',
                        'key' => 'apps/chat'
                    ],
                    'apps_kanban' => [
                        'title' => 'Kanban Board',
                        'route_name' => [
                            'name' => 'apps.kanban'
                        ],
                        'path_name' => '/kanban',
                        'key' => 'apps/kanban'
                    ],
                    'apps_filemanager' => [
                        'title' => 'File Manager',
                        'route_name' => [
                            'name' => 'apps.filemanager'
                        ],
                        'path_name' => '/filemanager',
                        'key' => 'apps/filemanager'
                    ],
                    'apps_mail' => [
                        'title' => 'Mail App',
                        'route_name' => [
                            'name' => 'apps.mail'
                        ],
                        'path_name' => '/mail',
                        'key' => 'apps/mail'
                    ],
                    'apps_todo' => [
                        'title' => 'Todo App',
                        'route_name' => [
                            'name' => 'apps.todo'
                        ],
                        'path_name' => '/todo',
                        'key' => 'apps/todo'
                    ],
                ],
                [
                    'apps_nft_1' => [
                        'title' => 'NFT Apps v1',
                        'route_name' => [
                            'name' => 'apps.nft1'
                        ],
                        'path_name' => '/nft1',
                        'key' => 'apps/nft1'
                    ],
                    'apps_nft_2' => [
                        'title' => 'NFT Apps v2',
                        'route_name' => [
                            'name' => 'apps.nft2'
                        ],
                        'path_name' => '/nft2',
                        'key' => 'apps/nft2'
                    ],
                    'apps_pos' => [
                        'title' => 'POS System',
                        'route_name' => [
                            'name' => 'apps.pos'
                        ],
                        'path_name' => '/pos',
                        'key' => 'apps/pos'
                    ],
                    'apps_travel' => [
                        'title' => 'Travel App',
                        'route_name' => [
                            'name' => 'apps.travel'
                        ],
                        'path_name' => '/travel',
                        'key' => 'apps/travel'
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
                            'name' => 'dashboards.crm-analytics'
                        ],
                        'path_name' => 'crm-analytics',
                        'key' => 'dashboards/crm-analytics'
                    ],
                    'dashboards_orders' => [
                        'title' => 'Orders',
                        'route_name' => [
                            'name' => 'dashboards.orders'
                        ],
                        'path_name' => 'orders',
                        'key' => 'dashboards/orders'
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
                                    'name' => 'dashboards.crypto-1'
                                ],
                                'path_name' => 'crypto-1',
                                'key' => 'dashboards/crypto-1'
                            ],
                            'dashboards_crypto_2' => [
                                'title' => 'Cryptocurrency v2',
                                'route_name' => [
                                    'name' => 'dashboards.crypto-2'
                                ],
                                'path_name' => 'crypto-2',
                                'key' => 'dashboards/crypto-2'
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
                                    'name' => 'dashboards.banking-1'
                                ],
                                'path_name' => 'banking-1',
                                'key' => 'dashboards/banking-1'
                            ],
                            'dashboards_banking_2' => [
                                'title' => 'Banking v2',
                                'route_name' => [
                                    'name' => 'dashboards.banking-2'
                                ],
                                'path_name' => 'banking-2',
                                'key' => 'dashboards/banking-2'
                            ]
                        ]
                    ],
                    'dashboards_personal' => [
                        'title' => 'Personal',
                        'route_name' => [
                            'name' => 'dashboards.personal'
                        ],
                        'path_name' => 'personal',
                        'key' => 'dashboards/personal'
                    ],
                    'dashboards_cms_analytics' => [
                        'title' => 'CMS Analytics',
                        'route_name' => [
                            'name' => 'dashboards.cms-analytics'
                        ],
                        'path_name' => 'cms-analytics',
                        'key' => 'dashboards/cms-analytics'
                    ],
                    'dashboards_influencer' => [
                        'title' => 'Influencer',
                        'route_name' => [
                            'name' => 'dashboards.influencer'
                        ],
                        'path_name' => 'influencer',
                        'key' => 'dashboards/influencer'
                    ],
                    'dashboards_travel' => [
                        'title' => 'Travel',
                        'route_name' => [
                            'name' => 'dashboards.travel'
                        ],
                        'path_name' => 'travel',
                        'key' => 'dashboards/travel'
                    ],
                    'dashboards_teacher' => [
                        'title' => 'Teacher',
                        'route_name' => [
                            'name' => 'dashboards.teacher'
                        ],
                        'path_name' => 'teacher',
                        'key' => 'dashboards/teacher'
                    ],
                    'dashboards_education' => [
                        'title' => 'Education',
                        'route_name' => [
                            'name' => 'dashboards.education'
                        ],
                        'path_name' => 'education',
                        'key' => 'dashboards/education'
                    ],
                    'dashboards_authors' => [
                        'title' => 'Authors',
                        'route_name' => [
                            'name' => 'dashboards.authors'
                        ],
                        'path_name' => 'authors',
                        'key' => 'dashboards/authors'
                    ],
                    'dashboards_doctor' => [
                        'title' => 'Doctor',
                        'route_name' => [
                            'name' => 'dashboards.doctor'
                        ],
                        'path_name' => 'doctor',
                        'key' => 'dashboards/doctor'
                    ],
                    'dashboards_employees' => [
                        'title' => 'Employees',
                        'route_name' => [
                            'name' => 'dashboards.employees'
                        ],
                        'path_name' => 'employees',
                        'key' => 'dashboards/employees'
                    ],
                    'dashboards_workspaces' => [
                        'title' => 'Workspaces',
                        'route_name' => [
                            'name' => 'dashboards.workspaces'
                        ],
                        'path_name' => 'workspaces',
                        'key' => 'dashboards/workspaces'
                    ],
                    'dashboards_meetings' => [
                        'title' => 'Meetings',
                        'route_name' => [
                            'name' => 'dashboards.meetings'
                        ],
                        'path_name' => 'meetings',
                        'key' => 'dashboards/meetings'
                    ],
                    'dashboards_project_boards' => [
                        'title' => 'Project Boards',
                        'route_name' => [
                            'name' => 'dashboards.project-boards'
                        ],
                        'path_name' => 'project-boards',
                        'key' => 'dashboards/project-boards'
                    ],
                ],
                [
                    'dashboards_widget_ui' => [
                        'title' => 'Widget UI',
                        'route_name' => [
                            'name' => 'dashboards.widget-ui'
                        ],
                        'path_name' => 'widget-ui',
                        'key' => 'dashboards/widget-ui'
                    ],
                    'dashboards_widget_contacts' => [
                        'title' => 'Widget Contacts',
                        'route_name' => [
                            'name' => 'dashboards.widget-contacts'
                        ],
                        'path_name' => 'widget-contacts',
                        'key' => 'dashboards/widget-contacts'
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
                        'key' => 'operacional/users'
                    ],
                    'operacional_role' => [
                        'title' => 'Roles',
                        'route_name' => [
                            'name' => 'roles.index'
                        ],
                        'path_name' => '/roles',
                        'key' => 'operacional/roles'
                    ],
                    'operacional_permission' => [
                        'title' => 'Permissions',
                        'route_name' => [
                            'name' => 'permissions.index'
                        ],
                        'path_name' => '/permissions',
                        'key' => 'operacional/permissions'
                    ],
                    'operacional_make' => [
                        'title' => 'Makes',
                        'route_name' => [
                            'name' => 'makes.index'
                        ],
                        'path_name' => '/makes',
                        'key' => 'operacional/makes'
                    ],
                ],
            ]
        ];
    }


    public static function all()
    {
        return [self::dashboards(), self::apps(), self::layouts(), self::forms(), self::components(), self::elements(), self::oprational()];
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
