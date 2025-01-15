<?php

$finder = PhpCsFixer\Finder::create()->in('/var/www/html/src');

$config = new PhpCsFixer\Config();

return $config
    ->setRules([
        '@PER' => true,
        '@PHP82Migration' => true,
        // Alias
        'backtick_to_shell_exec' => true,
        'no_alias_language_construct_call' => true,
        'no_mixed_echo_print' => [
            'use' => 'echo'
        ],
        // Array
        'array_syntax' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_whitespace_before_comma_in_array' => true,
        'normalize_index_brace' => true,
        'trim_array_spaces' => true,
        'whitespace_after_comma_in_array' => [
            'ensure_single_space' => true
        ],
        // Basic
        'braces' => [
            'allow_single_line_anonymous_class_with_empty_body' => true,
            'allow_single_line_closure' => true
        ],
        'encoding' => true,
        'octal_notation' => true,
        // Casing
        'class_reference_name_casing' => true,
        'constant_case' => [
            'case' => 'lower'
        ],
        'integer_literal_case' => true,
        'lowercase_keywords' => true,
        'lowercase_static_reference' => true,
        'magic_constant_casing' => true,
        'magic_method_casing' => true,
        'native_function_casing' => true,
        'native_function_type_declaration_casing' => true,
        // Cast notation
        'cast_spaces' => [
            'space' => 'single'
        ],
        'lowercase_cast' => true,
        'no_short_bool_cast' => true,
        'no_unset_cast' => true,
        'short_scalar_cast' => true,
        // Class notation
        'class_attributes_separation' => [
            'elements' => [
                'const' => 'one',
                'method' => 'one',
                'property' => 'one',
                'trait_import' => 'one',
                'case' => 'one'
            ]
        ],
        'class_definition' => [
            'single_line' => true,
            'space_before_parenthesis' => true,
        ],
        'no_blank_lines_after_class_opening' => true,
        'ordered_class_elements' => [
            'order' => [
                'use_trait'
            ]
        ],
        'protected_to_private' => true,
        'single_class_element_per_statement' => [
            'elements' => [
                'const',
                'property'
            ]
        ],
        'single_trait_insert_per_statement' => true,
        'visibility_required' => [
            'elements' => [
                'const',
                'method',
                'property'
            ]
        ],
        // Comment
        'multiline_comment_opening_closing' => true,
        'no_empty_comment' => true,
        'no_trailing_whitespace_in_comment' => true,
        'single_line_comment_spacing' => true,
        'single_line_comment_style' => [
            'comment_types' => ['hash']
        ],
        // Control structure
        'control_structure_braces' => true,
        'elseif' => true,
        'empty_loop_body' => [
            'style' => 'braces'
        ],
        'empty_loop_condition' => [
            'style' => 'while'
        ],
        'include' => true,
        'no_alternative_syntax' => true,
        'no_break_comment' => [
            'comment_text' => 'no break'
        ],
        'no_unneeded_control_parentheses' => [
            'statements' => [
                'break',
                'clone',
                'continue',
                'echo_print',
                'negative_instanceof',
                'others',
                'return',
                'switch_case',
                'yield',
                'yield_from'
            ]
        ],
        'no_unneeded_curly_braces' => [
            'namespaces' => true,
        ],
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'switch_continue_to_break' => true,
        'trailing_comma_in_multiline' => [
            'after_heredoc' => false,
            'elements' => ['arrays']
        ],
        // Function Notation
        'function_declaration' => [
            'closure_function_spacing' => 'one',
            'closure_fn_spacing' => 'one',
            'trailing_comma_single_line' => false
        ],
        'function_typehint_space' => true,
        'lambda_not_used_import' => true,
        'method_argument_space' => [
            'on_multiline' => 'ignore'
        ],
        'no_spaces_after_function_name' => true,
        'return_type_declaration' => [
            'space_before' => 'none'
        ],
        // Import
        'fully_qualified_strict_types' => true,
        'global_namespace_import' => [
            'import_classes' => false,
            'import_constants' => false,
            'import_functions' => false
        ],
        'no_leading_import_slash' => true,
        'no_unused_imports' => true,
        'ordered_imports' => [
            'imports_order' => [
                'class',
                'function',
                'const'
            ],
            'sort_algorithm' => 'length'
        ],
        'single_import_per_statement' => [
            'group_to_single_imports' => true
        ],
        'single_line_after_imports' => true,
        // Language construct
        'declare_equal_normalize' => [
            'space' => 'none'
        ],
        'declare_parentheses' => true,
        'explicit_indirect_variable' => true,
        'single_space_after_construct' => [
            'constructs' => [
                'abstract',
                'as',
                'attribute',
                'break',
                'case',
                'catch',
                'class',
                'clone',
                'comment',
                'const',
                'const_import',
                'continue',
                'do',
                'echo',
                'else',
                'elseif',
                'enum',
                'extends',
                'final',
                'finally',
                'for',
                'foreach',
                'function',
                'function_import',
                'global',
                'goto',
                'if',
                'implements',
                'include',
                'include_once',
                'instanceof',
                'insteadof',
                'interface',
                'match',
                'named_argument',
                'namespace',
                'new',
                'open_tag_with_echo',
                'php_doc',
                'php_open',
                'print',
                'private',
                'protected',
                'public',
                'readonly',
                'require',
                'require_once',
                'return',
                'static',
                'switch',
                'throw',
                'trait',
                'try',
                'type_colon',
                'use',
                'use_lambda',
                'use_trait',
                'var',
                'while',
                'yield',
                'yield_from'
            ]
        ],
        // List Notation
        'list_syntax' => [
            'syntax' => 'short'
        ],
        // Namespace Notation
        'blank_line_after_namespace' => true,
        'clean_namespace' => true,
        'no_leading_namespace_whitespace' => true,
        // Operator
        'standardize_increment' => true,
        'standardize_not_equals' => true,
        'ternary_operator_spaces' => true,
        'ternary_to_null_coalescing' => true,
        'unary_operator_spaces' => true,
        'assign_null_coalescing_to_coalesce_equal' => true,
        'binary_operator_spaces' => true,
        'concat_space' => [
            'spacing' => 'one'
        ],
        'increment_style' => [
            'style' => 'pre'
        ],
        'new_with_braces' => [
            'named_class' => true,
            'anonymous_class' => true
        ],
        'no_space_around_double_colon' => true,
        'no_useless_nullsafe_operator' => true,
        'object_operator_without_whitespace' => true,
        'operator_linebreak' => [
            'only_booleans' => true,
            'position' => 'end'
        ],
        // PHP Tag
        'blank_line_after_opening_tag' => true,
        'echo_tag_syntax' => [
            'format' =>  'long',
            'long_function' => 'echo',
            'shorten_simple_statements_only' => true
        ],
        'full_opening_tag' => true,
        'linebreak_after_opening_tag' => true,
        'no_closing_tag' => true,
        // PHP doc
        'align_multiline_comment' => [
            'comment_type' => 'phpdocs_only'
        ],
        'general_phpdoc_tag_rename' => [
            'replacements' => [
                'inheritDocs' => 'inheritDoc',
                '{@inheritDoc}' => '@inheritDoc'
            ]
        ],
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_phpdoc' => true,
        'phpdoc_add_missing_param_annotation' => [
            'only_untyped' => false
        ],
        'phpdoc_align' => [
            'align' => 'left'
        ],
        'phpdoc_annotation_without_dot' => true,
        'phpdoc_indent' => true,
        'phpdoc_inline_tag_normalizer' => [
            'tags' => ['example', 'id', 'internal', 'inheritdoc', 'inheritdocs', 'link', 'source', 'toc', 'tutorial']
        ],
        'phpdoc_no_access' => true,
        'phpdoc_no_alias_tag' => true,
        'phpdoc_no_package' => true,
        'phpdoc_order' => [
            'order' => ['param', 'return', 'throws']
        ],
        'phpdoc_return_self_reference' => [
            'replacements' => [
                'this' => '$this',
                '@this' => '$this',
                '$self' => 'self',
                '@self' => 'self',
                '$static' => 'static',
                '@static' => 'static'
            ]
        ],
        'phpdoc_scalar' => [
            'types' => [
                'boolean',
                'callback',
                'double',
                'integer',
                'real',
                'str'
            ]
        ],
        'phpdoc_separation' => [
            'groups' => [
                ['deprecated', 'link', 'see', 'since'],
                ['author', 'copyright', 'license'],
                ['category', 'package', 'subpackage'],
                ['property', 'property-read', 'property-write']
            ]
        ],
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => false,
        'phpdoc_to_comment' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => false,
        'phpdoc_var_annotation_correct_order' => true,
        'phpdoc_var_without_name' => true,
        // Return Notation
        'no_useless_return' => true,
        // Semicolon
        'no_empty_statement' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'semicolon_after_instruction' => true,
        'space_after_semicolon' => true,
        // String Notation
        'explicit_string_variable' => true,
        'heredoc_to_nowdoc' => true,
        'no_binary_string' => true,
        'simple_to_complex_string_variable' => true,
        'single_quote' => [
            'strings_containing_single_quote_chars' => true
        ],
        // Whitespace
        'array_indentation' => true,
        'blank_line_before_statement' => [
            'statements' => [
                'break',
                'continue',
                'declare',
                'return',
                'throw',
                'try',
                'phpdoc',
                'require',
                'require_once',
                'switch',
                'yield',
                'yield_from'
            ]
        ],
        'blank_line_between_import_groups' => true,
        'compact_nullable_typehint' => true,
        'heredoc_indentation' => [
            'indentation' => 'start_plus_one'
        ],
        'indentation_type' => true,
        'line_ending' => true,
        'method_chaining_indentation' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                'attribute',
                'break',
                'case',
                'continue',
                'curly_brace_block',
                'default',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'switch',
                'throw',
                'use'
            ]
        ],
        'no_spaces_around_offset' => [
            'positions' => [
                'inside',
                'outside'
            ]
        ],
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_whitespace' => true,
        'no_whitespace_in_blank_line' => true,
        'single_blank_line_at_eof' => true,
        'types_spaces' => [
            'space' => 'none',
            'space_multiple_catch' => null
        ],
    ])
    ->setFinder($finder);
