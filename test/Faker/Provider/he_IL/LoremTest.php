<?php

namespace Faker\Test\Provider\he_IL;

use Faker\Provider\he_IL\Lorem;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class LoremTest extends TestCase
{
    public function testTextThrowsExceptionWhenAskedTextSizeLessThan5()
    {
        $this->expectException(\InvalidArgumentException::class);
        Lorem::text(4);
    }

    public function testTextReturnsWordsWhenAskedSizeLessThan25()
    {
        self::assertEquals('מילה מילה מילה מילה.', TestableLorem::text(24));
    }

    public function testTextReturnsSentencesWhenAskedSizeLessThan100()
    {
        self::assertEquals('זהו משפט קצר למטרת ניסיון. זהו משפט קצר למטרת ניסיון. זהו משפט קצר למטרת ניסיון.', TestableLorem::text(99));
    }

    public function testTextReturnsParagraphsWhenAskedSizeGreaterOrEqualThanThan100()
    {
        self::assertEquals('זהו פרק קצר לצורך ניסיון. בפרק ישנם שלושה משפטים. שלושה בדיוק.', TestableLorem::text(100));
    }

    public function testSentenceWithZeroNbWordsReturnsEmptyString()
    {
        self::assertEquals('', Lorem::sentence(0));
    }

    public function testSentenceWithNegativeNbWordsReturnsEmptyString()
    {
        self::assertEquals('', Lorem::sentence(-1));
    }

    public function testParagraphWithZeroNbSentencesReturnsEmptyString()
    {
        self::assertEquals('', Lorem::paragraph(0));
    }

    public function testParagraphWithNegativeNbSentencesReturnsEmptyString()
    {
        self::assertEquals('', Lorem::paragraph(-1));
    }

    public function testSentenceWithPositiveNbWordsReturnsAtLeastOneWord()
    {
        $sentence = Lorem::sentence(1);

        self::assertGreaterThan(1, strlen($sentence));
        self::assertGreaterThanOrEqual(1, count(explode(' ', $sentence)));
    }

    public function testParagraphWithPositiveNbSentencesReturnsAtLeastOneWord()
    {
        $paragraph = Lorem::paragraph(1);

        self::assertGreaterThan(1, strlen($paragraph));
        self::assertGreaterThanOrEqual(1, count(explode(' ', $paragraph)));
    }

    public function testWordssAsText()
    {
        $words = TestableLorem::words(2, true);

        self::assertEquals('מילה מילה', $words);
    }

    public function testSentencesAsText()
    {
        $sentences = TestableLorem::sentences(2, true);

        self::assertEquals('זהו משפט קצר למטרת ניסיון. זהו משפט קצר למטרת ניסיון.', $sentences);
    }

    public function testParagraphsAsText()
    {
        $paragraphs = TestableLorem::paragraphs(2, true);

        $expected = "זהו פרק קצר לצורך ניסיון. בפרק ישנם שלושה משפטים. שלושה בדיוק."
            . "\n\n"
            . "זהו פרק קצר לצורך ניסיון. בפרק ישנם שלושה משפטים. שלושה בדיוק.";
        self::assertEquals($expected, $paragraphs);
    }
}

/**
 * @group legacy
 */
final class TestableLorem extends Lorem
{
    public static function word()
    {
        return 'מילה';
    }

    public static function sentence($nbWords = 5, $variableNbWords = true)
    {
        return 'זהו משפט קצר למטרת ניסיון.';
    }

    public static function paragraph($nbSentences = 3, $variableNbSentences = true)
    {
        return 'זהו פרק קצר לצורך ניסיון. בפרק ישנם שלושה משפטים. שלושה בדיוק.';
    }
}
