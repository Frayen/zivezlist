<?php


namespace App\Validator\Constraints;


use http\Exception\UnexpectedValueException;
use Symfony\Component\HttpFoundation\File\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SortValidator extends ConstraintValidator
{
    const TITLE = 'TITLE_ROMAJI';
    const POPULARITY = 'POPULARITY';
    const SCORE = 'SCORE';
    const TRENDING = 'TRENDING';
    const FAVOURITES = 'FAVOURITES';
    const DATE_ADDED = 'ID_DESC';
    const RELEASE_DATE = 'START_DATE_DESC';
    const SEARCH_MATCH = 'SEARCH_MATCH';
    const SORTS = [
        self::TITLE, self::POPULARITY,
        self::SCORE, self::TRENDING,
        self::FAVOURITES, self::DATE_ADDED,
        self::RELEASE_DATE, self::SEARCH_MATCH
    ];

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ConstraintValidator) {
            throw new UnexpectedTypeException($constraint, Sort::class);
        }

        if (!is_string($value)){
            throw new UnexpectedValueException();
        }

        if (!in_array($value, self::SORTS) && !empty($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}