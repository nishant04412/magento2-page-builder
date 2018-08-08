/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

export interface WysiwygConfigInitializerInterface {
    initialize(contentTypeId: string, config: any): void;
}

export default WysiwygConfigInitializerInterface;
