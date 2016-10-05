/**
 * Created by smart on 10/4/2016.
 */
define(
    [],
    function () {
        'use strict';
        return {
            getRules: function() {
                return {
                    'postcode': {
                        'required': true
                    },
                    'country_id': {
                        'required': true
                    },
                    'baybanbua_term_checkbox':{
                        'checked': true
                    }
                };
            }
        };
    }
)
