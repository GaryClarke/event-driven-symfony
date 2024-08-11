<?php

declare(strict_types=1);

namespace App\Tests\Unit\CDP\Analytics\Model;

use App\CDP\Analytics\Model\ModelValidator;
use App\CDP\Analytics\Model\Subscription\Identify\IdentifyModel;
use App\Error\Exception\WebhookException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class ModelValidatorTest extends TestCase
{
    private ModelValidator $unit;

    protected function setUp(): void
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAttributeMapping()
            ->getValidator();

        $this->unit = new ModelValidator($validator);
    }

    public function testInvalidIdentifyModelFailsValidation(): void
    {
        $model = new IdentifyModel();
        $model->setProduct('');
        $model->setEmail('not-an-email');
        $model->setEventDate('12-12-2001');
        $model->setSubscriptionId('12334');
        $model->setId('some-id');

        try {
            $this->unit->validate($model);
            $this->fail('No exception was thrown');
        } catch (WebhookException $exception) {
            $this->assertEquals(
                'Invalid IdentifyModel properties: product, eventDate, email',
                $exception->getMessage()
            );
        }
    }

    public function testValidIdentifyModelPassesValidation(): void
    {
        $model = new IdentifyModel();
        $model->setProduct('some-product');
        $model->setEmail('email@example.com');
        $model->setEventDate('2025-01-01');
        $model->setSubscriptionId('12334');
        $model->setId('some-id');

        try {
            $this->unit->validate($model);
            $this->assertTrue(true, 'No WebhookException was thrown');
        } catch (WebhookException) {
            $this->fail('Unexpected exception thrown');
        }
    }
}
