<?php

declare (strict_types=1);
namespace RectorPrefix20220609;

use Rector\CodingStyle\Rector\Assign\PHPStormVarAnnotationRector;
use Rector\CodingStyle\Rector\Assign\SplitDoubleAssignRector;
use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\CodingStyle\Rector\Class_\AddArrayDefaultToArrayPropertyRector;
use Rector\CodingStyle\Rector\ClassConst\RemoveFinalFromConstRector;
use Rector\CodingStyle\Rector\ClassConst\SplitGroupedConstantsAndPropertiesRector;
use Rector\CodingStyle\Rector\ClassConst\VarConstantCommentRector;
use Rector\CodingStyle\Rector\ClassMethod\MakeInheritedMethodVisibilitySameAsParentRector;
use Rector\CodingStyle\Rector\ClassMethod\NewlineBeforeNewAssignSetRector;
use Rector\CodingStyle\Rector\ClassMethod\RemoveDoubleUnderscoreInMethodNameRector;
use Rector\CodingStyle\Rector\ClassMethod\UnSpreadOperatorRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\Encapsed\WrapEncapsedVariableInCurlyBracesRector;
use Rector\CodingStyle\Rector\FuncCall\CallUserFuncArrayToVariadicRector;
use Rector\CodingStyle\Rector\FuncCall\ConsistentImplodeRector;
use Rector\CodingStyle\Rector\FuncCall\ConsistentPregDelimiterRector;
use Rector\CodingStyle\Rector\FuncCall\VersionCompareFuncCallToConstantRector;
use Rector\CodingStyle\Rector\If_\NullableCompareToNullRector;
use Rector\CodingStyle\Rector\Plus\UseIncrementAssignRector;
use Rector\CodingStyle\Rector\PostInc\PostIncDecToPreIncDecRector;
use Rector\CodingStyle\Rector\Property\AddFalseDefaultToBoolPropertyRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\CodingStyle\Rector\String_\SymplifyQuoteEscapeRector;
use Rector\CodingStyle\Rector\Switch_\BinarySwitchToIfElseRector;
use Rector\CodingStyle\Rector\Ternary\TernaryConditionVariableAssignmentRector;
use Rector\CodingStyle\Rector\Use_\SeparateMultiUseImportsRector;
use Rector\Config\RectorConfig;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Transform\Rector\FuncCall\FuncCallToConstFetchRector;
return static function (RectorConfig $rectorConfig) : void {
    $rectorConfig->ruleWithConfiguration(FuncCallToConstFetchRector::class, ['php_sapi_name' => 'PHP_SAPI', 'pi' => 'M_PI']);
    $rectorConfig->rules([SeparateMultiUseImportsRector::class, RemoveDoubleUnderscoreInMethodNameRector::class, PostIncDecToPreIncDecRector::class, UnSpreadOperatorRector::class, NewlineAfterStatementRector::class, RemoveFinalFromConstRector::class, PHPStormVarAnnotationRector::class, NullableCompareToNullRector::class, BinarySwitchToIfElseRector::class, ConsistentImplodeRector::class, TernaryConditionVariableAssignmentRector::class, SymplifyQuoteEscapeRector::class, SplitGroupedConstantsAndPropertiesRector::class, StringClassNameToClassConstantRector::class, ConsistentPregDelimiterRector::class, CatchExceptionNameMatchingTypeRector::class, UseIncrementAssignRector::class, SplitDoubleAssignRector::class, VarConstantCommentRector::class, EncapsedStringsToSprintfRector::class, WrapEncapsedVariableInCurlyBracesRector::class, NewlineBeforeNewAssignSetRector::class, AddArrayDefaultToArrayPropertyRector::class, AddFalseDefaultToBoolPropertyRector::class, MakeInheritedMethodVisibilitySameAsParentRector::class, CallUserFuncArrayToVariadicRector::class, VersionCompareFuncCallToConstantRector::class]);
};
